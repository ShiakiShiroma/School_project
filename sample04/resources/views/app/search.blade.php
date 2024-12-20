@extends('layouts.base')

@section('title','ログ　検索ページ')

@section('heading','ログ　検索ページ')


@section('errors')
	@if($errors->has('q'))
		<h3>error:条件が未定です</h3>
	@endif
	@if($errors->has('q1') || $errors->has('q2'))
		<h3>error:範囲が未定です</h3>
	@endif
@endsection

@section('content1')

<table border="1">
<tr>
	<th>全期間検索</th>
	<td>
	<form action="/search/all" method="GET">
	@csrf
		<input type="hidden" name="method" value="all" />
		<input type="hidden" name="q" value="all" />
		<input type="submit" value="送信" />
	</form>
	</td>
</tr>

<tr>
	<th>パラメータ名検索</th>
	<td>
	<form action="/search/paraName" method="GET">
	@csrf
		<input type="hidden" name="method" value="paraName" />
		<input type="text" value="" name="q"/>
		<input type="submit" value="送信" />
	</form>
	</td>
</tr>

<tr>
	<th>日付検索</th>
	<td>
	<form action="/search/date" method="GET">
	@csrf
		<input type="hidden" name="method" value="date" />
		<input type="date" value="" name="q"/>
		<input type="submit" value="送信" />
	</form>
	</td>
</tr>

<tr>
	<th>期間検索</th>
	<td>
	<form action="/search/range" method="GET">
	@csrf
		<input type="hidden" name="method" value="range" />
		<input type="date" name="q1" />
		<input type="date" name="q2" />
		<input type="submit" value="送信" />
	</form>
	</td>
</tr>

<tr>
	<th>良品・不良品検索</th>
	<td>
	<form action="/search/judgment" method="GET">
	@csrf
		<input type="hidden" name="method" value="judgment" />
		<label for="good"> 良品</label>
		<input type="radio" name="q" id="good" value="good"/>

		<label for="bad"> 不良品</label>
		<input type="radio" name="q" id="bad" value="bad"/>
		<input type="submit" value="送信" />
	</form>
</tr>
</table>
@endsection


@section('content2')
<a href='/index'>トップページへ戻る</a>
@endsection
