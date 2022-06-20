<div class="direct-chat-infos clearfix">
    <span
        class="direct-chat-name float-left">{{ $sg->user->name }}</span>
    <span
        class="direct-chat-timestamp float-right">{{ \Carbon\Carbon::parse($sg->created_at)->format('d M, Y') }}</span>
</div>
<img class="direct-chat-img"
    src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $sg->user->fi()]) }}"
    alt="message user image">
<!-- /.direct-chat-img -->
<div class="direct-chat-text">
    {{ $sg->body }}
</div>