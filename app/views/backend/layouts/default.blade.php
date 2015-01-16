@extends('frontend/layouts/default')

@section('body_bottom')
<!-- Confirmation Modal -->
<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('button.cancel')</button>
                <a class="btn btn-danger" id="dataConfirmOK">@lang('button.delete')</a>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript_bottom')
<script>
$(function () {
	$('#dataConfirmModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget);
	  var title = button.data('title');
	  var body = button.data('body');
	  var href = button.data('href');
	  var modal = $(this);
	  modal.find('.modal-title').text(title);
	  modal.find('.modal-body').text(body);
	  $('#dataConfirmOK').attr('href', href);
	});
});
</script>
@stop