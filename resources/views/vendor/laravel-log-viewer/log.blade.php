@extends('layouts.app')

@section('title', trans('logs.logs'))

@section('content')

<div class="logs container-fluid pt-3">
	<div class="row">
		<div class="col-12 col-md-2 sidebar mb-3">
			<h4>@lang('logs.logs')</h4>
			<div class="list-group">
				@foreach($files as $file)
					<a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}" class="list-group-item {{ $current_file == $file ? 'list-group-item-dark' : 'list-group-item-light' }}">
						{{$file}}
					</a>
				@endforeach
			</div>
		</div>
		<div class="col-12 col-md-10 table-container my-table">
			@if ($logs === null)
				<div>
					@lang('logs.more_than_50_mb')
				</div>
			@else
				<table id="table-log" class="table table-striped">
					<thead>
						<tr>
							<th>@lang('logs.level')</th>
							<th>@lang('logs.context')</th>
							<th>@lang('logs.date')</th>
							<th>@lang('logs.content')</th>
						</tr>
					</thead>
					<tbody>
						@foreach($logs as $key => $log)
							<tr data-display="stack{{{$key}}}">
								<td class="text-{{{$log['level_class']}}}">
									<span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span> 
									&nbsp;{{$log['level']}}
								</td>
								<td class="text">{{$log['context']}}</td>
								<td class="date">{{{$log['date']}}}</td>
								<td class="text">
									@if ($log['stack'])
										<button type="button" class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2" data-display="stack{{{$key}}}">
											<span class="fa fa-search"></span>
										</button>
									@endif
									{{{ $log['text'] }}}
									@if (isset($log['in_file'])) 
										<br/>{{{$log['in_file']}}}
									@endif
									@if ($log['stack'])
										<div class="stack" id="stack{{{$key}}}" style="display: none;  white-space: pre-wrap;">
											{{{ trim($log['stack']) }}}
										</div>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
			<div class="p-3">
				@if($current_file)
					<a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}" class="mr-1 p-2 badge badge-dark">
						<span class="fa fa-download mr-1"></span> 
						@lang('logs.download')
					</a>
					<a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}" class="mr-1 p-2 badge badge-danger">
						<span class="fa fa-trash mr-1"></span> 
						@lang('logs.delete')
					</a>
					@if(count($files) > 1)
						<a id="delete-all-log" href="?delall=true" class="mr-1 p-2 badge badge-danger">
							<span class="fa fa-trash mr-1"></span> 
							@lang('logs.delete_all_files')
						</a>
					@endif
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function () {
		$('.table-container tr').on('click', function () {
			$('#' + $(this).data('display')).toggle();
		});
		$('#table-log').DataTable({
			"order": [1, 'desc'],
			"stateSave": true,
			"stateSaveCallback": function (settings, data) {
				window.localStorage.setItem("datatable", JSON.stringify(data));
			},
			"stateLoadCallback": function (settings) {
				var data = JSON.parse(window.localStorage.getItem("datatable"));
				if (data) data.start = 0;
				return data;
			}
		});
		$('#delete-log, #delete-all-log').click(function () {
			return confirm('@lang('logs.are_u_sure')');
		});
	});
</script>

@endsection