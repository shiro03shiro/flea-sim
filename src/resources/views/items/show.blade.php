<p>商品詳細画面</p>

@if($liked)
<form method="POST" action="{{ route('items.unlike',$item->id) }}">
@csrf
@method('DELETE')
<button>いいね解除</button>
</form>
@else
<form method="POST" action="{{ route('items.like',$item->id) }}">
@csrf
<button>いいね</button>
</form>
@endif
@auth
<form method="POST" action="{{ route('items.comment',$item->id) }}">
@csrf
<textarea name="content"></textarea>
<button>コメントする</button>
</form>
@endauth
@foreach($item->comments as $comment)
<div>
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->content }}</p>
</div>
@endforeach