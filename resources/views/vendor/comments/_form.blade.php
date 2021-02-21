<div class="card">
    <div class="card-body">
        @if($errors->has('commentable_type'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_type') }}
            </div>
        @endif
        @if($errors->has('commentable_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_id') }}
            </div>
        @endif
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            {{-- Guest commenting --}}
            @if(isset($guest_commenting) and $guest_commenting == true)
                <div class="form-group">
                    <label for="message">@lang('comments::comments.enter_your_name_here')</label>
                    <input type="text" class="form-control @if($errors->has('guest_name')) is-invalid @endif" name="guest_name" />
                    @error('guest_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">@lang('comments::comments.enter_your_email_here')</label>
                    <input type="email" class="form-control @if($errors->has('guest_email')) is-invalid @endif" name="guest_email" />
                    @error('guest_email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                <textarea class="form-control @if($errors->has('message')) is-invalid @endif" name="message" rows="3"></textarea>
                <div class="invalid-feedback">
                    @lang('comments::comments.your_message_is_required')
                </div>
                <div class="stars" style="padding-top: 10px;">
                    <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                    <label id="dstar" class="star star-5" for="star-5"></label>
                    <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                    <label id="dstar" class="star star-4" for="star-4"></label>
                    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                    <label id="dstar" class="star star-3" for="star-3"></label>
                    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                    <label id="dstar" class="star star-2" for="star-2"></label>
                    <input class="star star-1" id="star-1" type="radio" name="star" value="1" checked/>
                    <label id="dstar" class="star star-1" for="star-1"></label>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.submit')</button>
        </form>
    </div>
</div>
<br />