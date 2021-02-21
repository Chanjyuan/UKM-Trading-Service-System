@inject('markdown', 'Parsedown')
@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
@endphp

<div id="comment-{{ $comment->getKey() }}" class="media">
    <img class="mr-3" src="/storage/uploads/{{$comment->commenter->image}}" alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar" style="width:45px; height:45px; border-radius:50%">
    <div class="media-body">
        <h5 class="mt-0 mb-1"><a href="/profile/{{ $comment->commenter->id }}">{{ $comment->commenter->fname ?? $comment->guest_name }} {{ $comment->commenter->lname }}</a><small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
        <div style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div>
        <div class="stars float-right" style="padding-top: 10px;">
            <input class="star star-5" type="radio" {{ ($comment->ratings->find($comment->id)->rating == "5")? "checked" : "" }} disabled/>
            <label class="star star-5" style="padding: 2px; font-size: 20px;"></label>
            <input class="star star-4" type="radio" {{ ($comment->ratings->find($comment->id)->rating == "4")? "checked" : "" }} disabled/>
            <label class="star star-4" style="padding: 2px; font-size: 20px;"></label>
            <input class="star star-3" type="radio" {{ ($comment->ratings->find($comment->id)->rating == "3")? "checked" : "" }} disabled/>
            <label class="star star-3" style="padding: 2px; font-size: 20px;"></label>
            <input class="star star-2" type="radio" {{ ($comment->ratings->find($comment->id)->rating == "2")? "checked" : "" }} disabled/>
            <label class="star star-2" style="padding: 2px; font-size: 20px;"></label>
            <input class="star star-1" type="radio" {{ ($comment->ratings->find($comment->id)->rating == "1")? "checked" : "" }} disabled/>
            <label class="star star-1" style="padding: 2px; font-size: 20px;"></label>
        </div>

        <div>
<!--             @can('reply-to-comment', $comment)
                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.reply')</button>
            @endcan -->
            @can('edit-comment', $comment)
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.edit')</button>
            @endcan
            @can('delete-comment', $comment)
                <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="btn btn-sm btn-link text-danger text-uppercase">@lang('comments::comments.delete')</a>
                <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            @endcan
        </div>

        @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                            @method('PUT')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">@lang('comments::comments.update_your_message_here')</label>
                                    <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                </div>
                                <div class="stars">
                                    <input class="star star-5" id="s5-{{$comment->id}}" type="radio" {{ ($comment->ratings->find($comment->id)->rating == "5")? "checked" : "" }} name="estar" value="5"/>
                                    <label id="dstar" class="star star-5" for="s5-{{$comment->id}}"></label>
                                    <input class="star star-4" id="s4-{{$comment->id}}" {{ ($comment->ratings->find($comment->id)->rating == "4")? "checked" : "" }} type="radio" name="estar" value="4"/>
                                    <label id="dstar" class="star star-4" for="s4-{{$comment->id}}"></label>
                                    <input class="star star-3" id="s3-{{$comment->id}}" {{ ($comment->ratings->find($comment->id)->rating == "3")? "checked" : "" }} type="radio" name="estar" value="3"/>
                                    <label id="dstar" class="star star-3" for="s3-{{$comment->id}}"></label>
                                    <input class="star star-2" id="s2-{{$comment->id}}" {{ ($comment->ratings->find($comment->id)->rating == "2")? "checked" : "" }} type="radio" name="estar" value="2"/>
                                    <label id="dstar" class="star star-2" for="s2-{{$comment->id}}"></label>
                                    <input class="star star-1" id="s1-{{$comment->id}}" {{ ($comment->ratings->find($comment->id)->rating == "1")? "checked" : "" }} type="radio" name="estar" value="1"/>
                                    <label id="dstar" class="star star-1" for="s1-{{$comment->id}}"></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.update')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('reply-to-comment', $comment)
            <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                                    <textarea required class="form-control" name="message" rows="3"></textarea>
                                </div>
                                <div class="stars">
                                    <input class="star star-5" id="s5r-{{ $comment->id }}" type="radio" name="rstar" value="5"/>
                                    <label id="rstar" class="star star-5" for="s5r-{{ $comment->id }}"></label>
                                    <input class="star star-4" id="s4r-{{ $comment->id }}" type="radio" name="rstar" value="4"/>
                                    <label id="rstar" class="star star-4" for="s4r-{{ $comment->id }}"></label>
                                    <input class="star star-3" id="s3r-{{ $comment->id }}" type="radio" name="rstar" value="3"/>
                                    <label id="rstar" class="star star-3" for="s3r-{{ $comment->id }}"></label>
                                    <input class="star star-2" id="s2r-{{ $comment->id }}" type="radio" name="rstar" value="2"/>
                                    <label id="rstar" class="star star-2" for="s2r-{{ $comment->id }}"></label>
                                    <input class="star star-1" id="s1r-{{ $comment->id }}" type="radio" name="rstar" value="1"/>
                                    <label id="rstar" class="star star-1" for="s1r-{{ $comment->id }}"></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <br />{{-- Margin bottom --}}

        <?php
            if (!isset($indentationLevel)) {
                $indentationLevel = 1;
            } else {
                $indentationLevel++;
            }
        ?>

        {{-- Recursion for children --}}
        @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
            {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
            @foreach($grouped_comments[$comment->getKey()] as $child)
                @include('comments::_comment', [
                    'comment' => $child,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif

    </div>
</div>

{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
    {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
    @foreach($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments
        ])
    @endforeach
@endif