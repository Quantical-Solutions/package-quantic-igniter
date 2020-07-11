<?php

namespace Quantic\Igniter\Seeder;

class DataSeeder
{
    public static function Seeder()
    {
        $seed = [
            'description' => 'The Quantic framework represents the new advance of Quantical Solutions in terms of innovation.
It is made up of different development modules as well as DevOps technologies like Docker. We find PHP 7.4, MySQL, React, React Native, Node.js, Webpack ...
The goal of Quantic is to facilitate cross-platform and multi-device development work. A solution for managing web app, mobile app and APIs.
A multi-layered solution bringing together the latest technologies, in their version or their reputation, in order to offer a new generation of digital solutions.',

            'email' => 'infos@quanticalsolutions.com',

            'logged' => true,

            'charts' => 'Mix and match bar and line charts to provide a clear visual distinction between datasets.
    Plot complex, sparse datasets on date time, logarithmic or even entirely custom scales with ease.
    Out of the box stunning transitions when changing data, updating colours and adding datasets.
    Chart.js is a community maintained project, contributions welcome!
    Visualize your data in 8 different ways; each of them animated and customisable.
    Great rendering performance across all modern browsers (IE11+).
    Redraws charts on window resize for perfect scale granularity.',

            'owl' => 'Fully Customisable - Over 60 options. Easy for novice users and even more powerful for advanced developers.
    Touch and Drag Support - Designed specially to boost mobile browsing experience. Mouse drag works great on desktop too!
    Fully Responsive - Almost all options are responsive and include very intuitive breakpoints settings.
    Modern Browsers - Owl uses hardware acceleration with CSS3 Translate3d transitions. Its fast and works like a charm!
    Zombie Browsers - CSS2 fallback supported for older browser.
    Modules and Plugins - Owl Carousel supports plugin modular structure. Therefore, you can detach plugins that you won\'t use on your project or create new ones that fit your needs',

            'fullcalendar' => 'Powerful and Lightweight - Has over 100 customizable settings. Built as separate modules to keep filesize down.
    Open Source - All code is open source and hosted on GitHub. ',

            'docker' => 'Developing apps today requires so much more than writing code. Multiple languages, frameworks, architectures, and discontinuous interfaces between tools for each lifecycle stage creates enormous complexity. Docker simplifies and accelerates your workflow, while giving developers the freedom to innovate with their choice of tools, application stacks, and deployment environments for each project.'
        ];
        
        return $seed;
    }
}