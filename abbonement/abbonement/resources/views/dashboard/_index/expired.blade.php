<?php
    use Carbon\Carbon;
?>
<div class="table-responsive {!! (! $allExpired->isEmpty() ? 'panel-scroll' : '')  !!}  ">
    <table class="table table-hover">
        @forelse($allExpired as $expired)
            <tr>
                <td>
                    <?php
                    $images = $expired->member->getMedia('profile');
                    $profileImage = ($images->isEmpty() ? 'https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg?t=st=1728560652~exp=1728564252~hmac=ddc44fc5bd3ceb49325937bba9a8a7fcf42fe0c863b7a36c7e32feb69f681140&w=740' : url($images[0]->getUrl('thumb')));
                    ?>
                    <a href="{{ action('MembersController@show',['id' => $expired->member->id]) }}">
                        <img src="{{ $profileImage }}"/></a>
                </td>

                <td>
                    <a href="{{ action('MembersController@show',['id' => $expired->member->id]) }}">
                        <span class="table-sub-data">{{ $expired->member->member_code }}</span></a>
                    <a href="{{ action('MembersController@show',['id' => $expired->member->id]) }}">
                        <span class="table-sub-data">{{ $expired->member->name }}</span></a>
                </td>
                <?php
                $daysGone = Carbon::today()->diffInDays($expired->end_date);
                ?>
                <td>
                    <span class="table-sub-data">{{ $expired->end_date->format('Y-m-d') }}<br></span>
                    <span class="table-sub-data">{{ Carbon::today()->subDays($daysGone)->diffForHumans() }}</span>
                </td>

                <td>
                    {!! Form::Open(['method' => 'POST','action' => ['SubscriptionsController@cancelSubscription',$expired->id]]) !!}
                    @permission(['manage-gymie','manage-subscriptions','cancel-subscription'])
                    <button class="btn btn-xs btn-danger pull-right margin-left-5" type="submit">Cancel</button>
                    @endpermission

                    @permission(['manage-gymie','manage-subscriptions','renew-subscription'])
                    <a class="btn btn-xs btn-info pull-right"
                       href="{{ action('SubscriptionsController@renew',['id' => $expired->invoice_id]) }}">Renew</a>
                    @endpermission
                    {!! Form::Close() !!}
                </td>
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                No Data
            </div>
        @endforelse
    </table>
</div>
@if(!$allExpired->isEmpty())
    <a class="btn btn-color btn-xs palette-concrete pull-right margin-right-10 margin-top-10"
       href="{{ action('SubscriptionsController@expired') }}">View All</a>
@endif