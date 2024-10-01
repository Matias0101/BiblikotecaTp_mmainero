<!-- resources/views/vendor/backpack/crud/fields/view.blade.php -->

<!-- Campo de solo visualización para Backpack -->
<div class="form-group col-md-12">
    <label>{!! $field['label'] !!}</label>
    <div>
     
        @if (isset($field['value']) && $field['value'] !== null)
            <p class="form-control-static">{!! $field['value'] !!}</p>
        @else
            <p class="form-control-static">No disponible</p>
        @endif

    </div>
</div>

  