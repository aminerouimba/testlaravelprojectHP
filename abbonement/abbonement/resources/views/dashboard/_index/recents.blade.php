<?php
    use Carbon\Carbon;
?>
<div class="table-responsive {!! (! $recents->isEmpty() ? 'panel-scroll' : '')  !!}">
    <table class="table table-hover table-condensed">
        @forelse($recents as $recent)
            <tr>
                <td>
                    <?php
                    $images = $recent->getMedia('profile');
                    $profileImage = ($images->isEmpty() ? 'https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg?t=st=1728560652~exp=1728564252~hmac=ddc44fc5bd3ceb49325937bba9a8a7fcf42fe0c863b7a36c7e32feb69f681140&w=740' : url($images[0]->getUrl('thumb')));
                    ?>
                    <a href="{{ action('MembersController@show',['id' => $recent->id]) }}"><img src="{{ $profileImage }}"/></a>
                </td>

                <td>
                    <a href="{{ action('MembersController@show',['id' => $recent->id]) }}"><span
                                class="table-sub-data">{{ $recent->member_code }}</span></a>
                    <a href="{{ action('MembersController@show',['id' => $recent->id]) }}"><span
                                class="table-sub-data">{{ $recent->name }}</span></a>
                </td>

                <td>
                    <?php
                    $daysGone = Carbon::today()->diffInDays($recent->created_at);
                    ?>
                    <span class="table-sub-data">{{ $recent->created_at->format('Y-m-d') }}<br></span>
                    <span class="table-sub-data">{{ Carbon::today()->subDays($daysGone)->diffForHumans() }}</span>
                </td>
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                No Data
            </div>
        @endforelse
    </table>
</div>
@if(!$recents->isEmpty())
    <a class="btn btn-color btn-xs palette-concrete pull-right margin-right-10 margin-top-10"
       href="{{ action('MembersController@index') }}">View All</a>
@endif