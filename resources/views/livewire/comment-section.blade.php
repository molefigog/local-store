<div>
    <section>
        <h5>{{ $comments->count() }} Comments</h5>

        @foreach ($comments as $comment)
            <div wire:key=" {{ $comment->id }}" class="comment-box">

                <div class="comment">
                    <div class="comment-head">
                        <div class="name">
                            {{-- <img  style="width: 40px; height 40px;" src="{{asset('storage/' . $comment->user->avatar)}}"alt=""class="profile-pic"/> --}}
                            <p class=""><span class="icon-user"></span> {{ $comment->user->name ?? 'Anonymous' }}
                            </p>
                            <p><span class="icon-calendar"></span> {{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="trailing">
                            @if (Auth::user() && $comment->user_id == Auth::user()->id)
                                {{-- Edit button --}}
                                {{-- <button class="reply btn btn-transparent" wire:click="editComment({{ $comment->id }}, $event.target.value)">
                            <span style="color: blue;" class="icon-pencil"></span>
                        </button> --}}
                                {{-- Delete button --}}
                                <button class="reply btn btn-transparent"
                                    wire:click="deleteComment({{ $comment->id }})">
                                    <span style="color: red;" class="icon-trash-o"></span>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="comment-body">
                        <p class="ml-3 ddd"><span class="icon-comments-o"></span> {{ $comment->content }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        @if (Auth::user())
            <div class="comment-text">
                <img style="width: 40px; height 40px;" src="{{ asset('storage/' . Auth::user()->avatar) }}"
                    alt="" />
                <form wire:submit.prevent="addComment">
                    <textarea wire:model="newComment" id="comment-text-area"cols="30" rows="4" placeholder="Add a comment"></textarea>
                    {{-- <input wire:model="user" type="text" value="{{Auth::user()->id}}"> --}}
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm text-center"> comment</button>
                    </div>
                </form>
            </div>
        @else
            <p><a href="#" data-toggle="modal" data-target="#exampleModal">Login to comment</a></p>
        @endif
    </section>
</div>
