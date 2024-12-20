@extends('layouts.base')

@section('title','ログ検索結果')

@section('heading','ログ　検索結果')


@section('head-links')
<a href='/search'>ログ検索ページへ戻る</a>
<br>
<a href='/index'>トップページへ戻る</a>
@endsection

@section('content1')

@switch($method)
	@case("all")
		<p>検索：全期間検索</p>
	@break
	@case("paraName")
		<p>検索：パラメータ名検索</p>
		<p>内容：{{$q}}</p>
	@break
	@case("date")
		<p>検索：日付検索</p>
		<p>内容：{{$q}}</p>
	@break
	@case("range")
		<p>検索：期間検索</p>
		<p>内容：{{$q1}} ~ {{$q2}}</p>
	@break
	@case("judgment")
		<p>検索：ACTIVE検索</p>
		<p>内容：{{$q}}</p>
	@break
@endswitch

<p>{{ $logs->total() }}件中
@php
	echo count($logs) ."件表示</p>"
@endphp
	


<form action="{{ route('export/csv') }}" method="get">
@csrf
	<fieldset>
	<input type="hidden" name="method" value="{{ $method }}" >
@if($method == "range")
	<input type="hidden" name="q1" value="{{ $q1 }}" >
	<input type="hidden" name="q2" value="{{ $q2 }}" >
@else
	<input type="hidden" name="q" value="{{ $q }}" >
@endif
	<label>検索結果をダウンロード
	<input type="submit" value="ダウンロード">
	</label>
	</fieldset>
</form>


<table border="1">
	<thead>
	<tr>
		<th>番号</th>
		<th>画像名</th>
		<th>パラメータ名</th>
		<th>ヨコ幅</th>
		<th>タテ幅</th>
		<th>判定</th>
		<th>作成日</th>
	</tr>
	</thead>

	<tbody>
@if(!isset($logs[0]))
	<tr>
		<td colspan="5">NO DATA EXISTS!!</td>
	</tr>

@else
@foreach($logs as $log)
	<tr>
		<td>{{$log["id"]}}</td>
		<td>{{$log["name"]}}</td>
		<td>{{$log["parameta_name"]}}</td>
		<td>{{$log["width"]}}</td>
		<td>{{$log["height"]}}</td>
		<td>{{$log["judgment"]}}</td>
		<td>{{$log["created_at"]}}</td>
		<td>
			<form method="get" action="{{ route('export/image') }}">
				<input type="hidden" name="log" value="{{ $log }}" />
				<input type="submit"  value="画像ダウンロード" />
			</form>
		</td>
	</tr>
@endforeach
@endif
	</tbody>
</table>
{{ $logs->appends(request()->query())->links()}}
@endsection


@section('bottom-links')
<hr>
<a href='/search'>検索ページへ戻る</a>
<br>
<a href='/index'>トップページへ戻る</a>
@endsection
