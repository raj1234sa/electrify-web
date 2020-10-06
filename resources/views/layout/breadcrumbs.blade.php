<div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
    <ul class="breadcrumb">
        @php
            if(isset($breadcrumbs)) {
                echo app\Http\draw_breadcrumb($breadcrumbs);
            }
        @endphp
    </ul><!-- /.breadcrumb -->
</div>
