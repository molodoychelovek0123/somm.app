@php
    $translation = $row->translateOrOrigin(app()->getLocale());
    $host_image = $row->getImagebyID($row->host_image);
@endphp

<div class="g-overview">
    <h3>{{ $translation->host_name }}</h3>
    <div class="description">

        <div class="row ">
            <div class="col-8">
                <?php echo $translation->host_description; ?>
            </div>

            <div class="col" style="">
                <div class="square-wrap">
                    <img src="{{ $host_image }}" alt="{{ $translation->host_name }}">
                </div>
            </div>
        </div>
    </div>
</div>



@php
    $terms_ids = $row->tour_term->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
@endphp
@if(!empty($terms_ids) and !empty($attributes))
    @foreach($attributes as $attribute )
        @php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) @endphp
        @if(empty($attribute['parent']['hide_in_single']))
            <div class="g-attributes {{$attribute['parent']->slug}} attr-{{$attribute['parent']->id}}">
                <h3>{{ $translate_attribute->name }}</h3>
                @php $terms = $attribute['child'] @endphp
                <div class="list-attributes">
                    @foreach($terms as $term )
                        @php $translate_term = $term->translateOrOrigin(app()->getLocale()) @endphp
                        <div class="attribute-wrap">
                            <div class="item {{$term->slug}} term-{{$term->id}}">
                                @if(!empty($term->image_id))
                                    @php $image_url = get_file_url($term->image_id, 'full'); @endphp
                                    <img src="{{$image_url}}" class="img-responsive" alt="{{$translate_term->name}}">
                                @else
                                    <i class="{{ $term->icon ?? "icofont-check-circled icon-default" }}"></i>
                                @endif
                                <span>
                              {{$translate_term->name}} </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@endif
