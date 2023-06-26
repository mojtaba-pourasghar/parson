@php
    if(!empty($url) )
      $url = str_replace('filter='.$filter_value.'&','',$url);
@endphp
<div class="dataTables_length pull-left" id="DataTables_Table_0_length"><label> @lang('message.show')
        محتویات
        <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control input-sm"
                onchange="if (this.value) window.location.href=this.value">
            @for($i = 1; $i <= 4 ; $i++)
                @if(!empty($url) && $url != route($route_address,isset($parameters)?$parameters :  ''))
                    <option
                        {{ (!empty($filter_value) && $filter_value == $i * getConstant('backend.step') ) ? 'selected' : '' }}
                        value="{{ $url.'&filter='.$i * getConstant('backend.step') }}">{{ $i * getConstant('backend.step') }}</option>
                @else
                    <option
                        {{ (!empty($filter_value) && $filter_value == $i * getConstant('backend.step') ) ? 'selected' : '' }}
                        value="{{ route($route_address,isset($parameters)?$parameters :  '').'?filter='.$i * getConstant('backend.step') }}">{{ $i * getConstant('backend.step') }}</option>
                @endif
            @endfor
        </select></label>
</div>
