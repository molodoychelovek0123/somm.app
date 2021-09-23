@foreach ($attributes as $attribute)
    <div class="panel">
        <div class="panel-title"><strong>{{__('Attribute: :name',['name'=>$attribute->name])}}</strong></div>
        <div class="panel-body">
            <div class="terms-scrollable">
                @foreach($attribute->terms as $term)
                    <label class="term-item">
                        <input @if(!empty($selected_terms) and $selected_terms->contains($term->id)) checked
                               @endif type="checkbox" name="terms[]" value="{{$term->id}}">
                        <span class="term-name">{{$term->name}}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
@endforeach

<div class="panel">
    <div class="panel-title"><strong>Additional block</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label">{{__("Title")}}</label>
            <input type="text" name="host_name" class="form-control" value="{{$translation->host_name}}"
                   placeholder="{{__("Meet your host, Mónica Marín")}}">
            <em>To avoid showing this block, leave the title empty</em>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Description")}}</label>
            <div class="">
                <textarea name="host_description" class="d-none has-ckeditor" cols="30" rows="10">
@if(!empty($translation->host_description)) {{$translation->host_description}} @else Description @endif
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Image ")}}</label>
            <div class="form-group-image">
                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('host_image',$row->host_image) !!}
            </div>
        </div>

    </div>
</div>
