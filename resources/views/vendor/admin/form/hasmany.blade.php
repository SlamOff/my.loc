<div class="row">
    <div class="col-md-{{$width['label']}}"><h4 class="pull-right">{{ $label }}</h4></div>
    <div class="col-md-{{$width['field']}}"></div>
</div>

<hr style="margin-top: 0px;">

<div id="has-many-{{$column}}" class="has-many-{{$column}}">

    <div class="has-many-{{$column}}-forms">

        @foreach($forms as $pk => $form)

            <div class="has-many-{{$column}}-form fields-group">

                @foreach($form->fields() as $field)
                    {!! $field->render() !!}
                @endforeach

                <div class="form-group">
                    <label class="col-sm-{{$width['label']}} control-label"></label>
                    <div class="col-sm-{{$width['field']}}">
                        @if($options['delete'])
                            <div class="remove btn btn-warning btn-sm pull-right"><i
                                        class="fa fa-trash">&nbsp;</i>{{ trans('admin::lang.remove') }}</div>
                        @endif
                    </div>
                </div>

                <hr>
            </div>

        @endforeach
    </div>

    <template class="{{$column}}-tpl">
        <div class="has-many-{{$column}}-form fields-group">

            {!! $template !!}

            <div class="form-group">
                <label class="col-sm-{{$width['label']}} control-label"></label>
                @if($options['delete'])
                    <div class="col-sm-{{$width['field']}}">
                        <div class="remove btn btn-warning btn-sm pull-right"><i
                                    class="fa fa-trash"></i>&nbsp;{{ trans('admin::lang.remove') }}</div>
                    </div>
                @endif
            </div>
            <hr>
        </div>
    </template>
    @if((!count($forms))&(!$options['add']))
        <?php
        //echo file_get_contents(base_path('/resources/views/vendor/admin/form/'.$options['tpl']));
        $template_ua = str_replace("__LA_KEY__", "1", $template);
        $template_en = str_replace("__LA_KEY__", "2", $template);
        if ($options['local'])
            $template_en = str_replace('value="en"', 'selected value="en"', $template);
        ?>
        <div class="has-many-local-form fields-group">
            {!! $template_ua !!}
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
            </div>
            <hr>
        </div>
        <div class="has-many-local-form fields-group">
            {!! $template_en !!}
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
            </div>
            <hr>
        </div>
    @endif
    <div class="form-group">
        <label class="col-sm-{{$width['label']}} control-label"></label>
        <div class="col-sm-{{$width['field']}}">
            @if($options['add'])
                <div class="add btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;{{ trans('admin::lang.new') }}
                </div>
            @endif
        </div>
    </div>

</div>