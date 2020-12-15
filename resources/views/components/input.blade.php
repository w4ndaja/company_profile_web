<div class="row form-group">
    @if($label)<label class="col-form-label col-md-4">{{$label}}</label>@endif
    <div class="@if($label) col-md-8 @else col-12 @endif">
        <input type="{{$type}}" name="{{$name}}" class="form-control @error($name) border-danger @enderror" value="{{$value}}" {{$checked}} {{$props}}>
        @error($name)
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
