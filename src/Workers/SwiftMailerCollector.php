<?php

namespace Quantic\Igniter\Workers;

use Carbon\Carbon;
use Jenssegers\Blade\Blade;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class SwiftMailerCollector
{
    public static array $report = [];

    public static function sendMail($data)
    {
        /*
         * Mail array model :
         *
         *  $mailArray = [
                // optional if only one 'from' contact
                'sender' => 'example@test.com',

                'from' => ['example@test.com' => 'Example'],
                'returnPath' => 'in-touch-fg@quanticalsolutions.com',
                'to' => ['fred.geffray@gmail.com' => 'Fred Geffray'],

                // Optional
                'priority' => 1,

                // Optional
                //'cc' => ['marionlaplagne24@gmail.com' => 'Mouillon'],
                'message' => 'Mon message en HTML',
                'subject' => 'Test des mails',

                // optional
                'signature' => 'Fred',
                'template' => ['view' => 'template_std', 'data' => ['test' => 'Test string']],

                // Optional
                'attach' => [
                    ['path' => 'path/to/file.ext', 'filename' => 'Logo QS.png']
                ],

                // Optional
                'attachCreate' => [
                    ['data' => '', 'filename' => '', 'type' => '']
                ],

                // Optional
                'embed' => ['path/to/file.ext'],

                // Optional
                'embedCreate' => [
                    ['data' => '', 'filename' => '', 'type' => '']
                ]
            ];

            sendMail($mailArray);
         *
         */

        $config = config('mail.mailers');

        $setFrom = (isset($data['from']) && !empty($data['from']))
            ? $data['from']
            : trigger_error('Mail function needs \'from\' data');

        $setReturnPath = (isset($data['returnPath']) && $data['returnPath'] != '')
            ? $data['returnPath']
            : trigger_error('Mail function needs \'returnPath\' to be filled');

        $setTo = (isset($data['to']) && !empty($data['to']))
            ? $data['to']
            : trigger_error('Mail function needs \'to\' data');

        $setBcc = (isset($data['cc']) && !empty($data['cc'])) ? $data['cc'] : [];

        $subject = (isset($data['subject']) && $data['subject'] != '')
            ? $data['subject']
            : trigger_error('Mail function needs \'subject\' to be filled');

        $priority = (isset($data['priority']) && $data['priority'] != '' && is_int($data['priority']) && $data['priority'] > 0 && $data['priority'] < 6)
            ? $data['priority']
            : 3;

        $template = (isset($data['template']) && isset($data['template']['view']) && !empty($data['template']['view']))
            ? $data['template']
            : trigger_error('Mail function needs \'template\' to be filled with an Array[\'view\' => \'path/to/view\', \'data\' => [\'varName\' => $var, ...]] (data is optional)');

        $signature = (isset($data['signature']) && $data['signature'] != '') ? $data['signature'] : '';

        $attach = (isset($data['attach']) && !empty($data['attach']))
            ? $data['attach']
            : [];

        $attachCreate = (isset($data['attachCreate']) && !empty($data['attachCreate']))
            ? $data['attachCreate']
            : [];

        $embed = (isset($data['embed']) && !empty($data['embed']))
            ? $data['embed']
            : [];

        if (file_exists(__DIR__ . '/views/mails/' . $template['view'] . '.blade.php')) {
            $embedVendor = [];
            $files = scandir(__DIR__ . '/mailsAssets/img');
            foreach ($files as $file) {
                if (is_file(__DIR__ . '/mailsAssets/img/' . $file) && $file != '.' && $file != '..') {
                    array_push($embedVendor, __DIR__ . '/mailsAssets/img/' . $file);
                }
            }
            $embed = $embedVendor;
        }

        $embedCreate = (isset($data['embedCreate']) && !empty($data['embedCreate']))
            ? $data['embedCreate']
            : [];

        // Create the Transport
        $transport = (new \Swift_SmtpTransport($config['smtp']['host'], $config['smtp']['port']))
            ->setUsername($config['smtp']['username'])
            ->setPassword($config['smtp']['password'])
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        self::isValidated($setFrom);
        self::isValidated($setTo);
        self::isValidated($setBcc);

        // Create a message
        $message = (new \Swift_Message($subject))
            ->setFrom($setFrom)
            ->setReturnPath($setReturnPath)
            ->setTo($setTo)
            ->setBcc($setBcc)
            ->setReadReceiptTo($setReturnPath)
            ->setPriority($priority);

        $attachArray = [];
        $embedArray = [];

        // Create attachment files
        foreach ($attach as $item) {
            if (isset($item['path']) && $item['path'] != ''
                && isset($item['filename']) && $item['filename'] != '') {

                $att = \Swift_Attachment::fromPath($item['path'])
                    ->setFilename($item['filename']);
                $message->attach($att);
                array_push($attachArray, $att);

            } else {
                trigger_error('Attachment files path field and filename field must be filled');
            }
        }

        // Create dynamic attachment files
        foreach ($attachCreate as $item) {
            if (isset($item['data']) && $item['data'] != ''
                && isset($item['filename']) && $item['filename'] != ''
                && isset($item['type']) && $item['type'] != '') {

                $att = new \Swift_Attachment($item['data'], $item['filename'], $item['type']);
                $message->attach($att);
                array_push($attachArray, $att);

            } else {
                trigger_error('Attachment files data field, filename field and type field must be filled');
            }
        }

        // Create embed files
        foreach ($embed as $item) {
            if (isset($item) && $item != '') {

                $em = $message->embed(\Swift_Image::fromPath($item));
                array_push($embedArray, $em);

            } else {
                trigger_error('Attachment files path field and alt field must be filled');
            }
        }

        // Create dynamic embed files
        foreach ($embedCreate as $item) {
            if (isset($item['data']) && $item['data'] != ''
                && isset($item['filename']) && $item['filename'] != ''
                && isset($item['type']) && $item['type'] != '') {

                $em = $message->embed(new \Swift_Image($item['data'], $item['filename'], $item['type']));
                array_push($embedArray, $em);

            } else {
                trigger_error('Attachment files data field, filename field and type field must be filled');
            }
        }

        if (!empty($embedArray)) {
            if (isset($template['data'])) {
                $template['data']['embed'] = $embedArray;
            } else {
                $template['data'] = ['embed' => $embedArray];
            }
        }

        $body = self::template($template);
        $message->setBody($body, 'text/html');

        $headers = ($message->getHeaders())->toString();

        $report = [
            'From' => $setFrom,
            'To' => $setTo,
            'Bcc' => $setBcc,
            'Subject' => $subject,
            'Priority' => $priority,
            'Body' => $body,
            'Signature' => $signature,
            'Host' => $config['smtp']['host'],
            'Port' => $config['smtp']['port'],
            'Template' => $template,
            'Attachments' => ['attach' => $attach, 'create' => $attachCreate],
        ];

        $head = self::splitHeaders($headers);
        foreach ($head as $key => $value) {
            $report[$key] = $value;
        }

        array_push(self::$report, $report);

        // Send the message
        $failures = [];
        /*if (!$mailer->send($message, $failures)) {
            trigger_error(implode(', ', $failures));
        }*/
    }

    private static function validateAddress($email)
    {
        $validator = new EmailValidator();
        return $validator->isValid($email, new RFCValidation());
    }

    private static function isValidated($array)
    {
        foreach ($array as $key => $value) {
            if (is_string($key)) {
                if (self::validateAddress($key) == false) {
                    trigger_error('"' . $key . '" is not a valid mail address');
                }
            } else {
                if (self::validateAddress($value) == false) {
                    trigger_error('"' . $value . '" is not a valid mail address');
                }
            }
        }
    }

    private static function splitHeaders($headers)
    {
        $head = [];
        $split = explode("\r\n", $headers);
        foreach ($split as $item) {
            if ($item != '' && isset(explode(': ', $item)[1])) {
                $key = trim(explode(': ', $item)[0]);
                $value = trim(explode(': ', $item)[1]);
                if ($key == 'Date') {
                    $date = date("Y-m-d H:i:s", strtotime($value));
                    $value = $date;
                }
                if ($key != 'Subject' && $key != 'From' && $key != 'To' && $key != 'Bcc') {
                    $head[$key] = $value;
                }
            }
        }
        return $head;
    }

    private static function template($template)
    {
        $view = $template['view'];
        $data = (isset($template['data']) && !empty($template['data'])) ? $template['data'] : false;
        $resources = (file_exists(ROOTDIR . '/resources/views/mails/' . $view . '.blade.php'))
            ? ROOTDIR . '/resources/views/mails'
            : __DIR__ . '/views/mails';

        $cache = (file_exists(ROOTDIR . '/resources/views/mails/' . $view . '.blade.php'))
            ? ROOTDIR . '/divine/cache/blade'
            : __DIR__ . '/views/cache';

        if (file_exists($resources . '/' . $view . '.blade.php')) {

            $blade = new Blade($resources, $cache);
            $template = ($data == false) ? $blade->render($view) : $blade->render($view, $data);
            return $template;

        } else {

            trigger_error('Template ' . $view . ' does not exist');
        }
    }
}