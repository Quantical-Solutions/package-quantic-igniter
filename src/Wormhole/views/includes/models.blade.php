<div class="wormholeIncludes" id="wormholeIncludeModels">
    @if(isset($models) && !empty($models))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($models) }} models were used</span>
        <ul id="wormholeModelsStack">
            @foreach($models as $model)
                <li>
                    <p>{{ $model['class'] }}</p>
                    <span>{{ $model['objects'] }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 model was used</span>
    @endif
</div>
@include('includes.form')