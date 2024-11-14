<div class="table-responsive {!! (! $birthdays->isEmpty() ? 'panel-scroll' : '')  !!}">
    <table class="table table-hover">
        @forelse($birthdays as $birthday)
            <tr>
                <?php
                $images = $birthday->getMedia('profile');
                $profileImage = ($images->isEmpty() ? 'https://img.freepik.com/vecteurs-libre/cercle-bleu-utilisateur-blanc_78370-4707.jpg?t=st=1728560652~exp=1728564252~hmac=ddc44fc5bd3ceb49325937bba9a8a7fcf42fe0c863b7a36c7e32feb69f681140&w=740' : url($images[0]->getUrl('thumb')));
                ?>
                <td><a href="{{ action('MembersController@show',['id' => $birthday->id]) }}"><img
                                src="{{ $profileImage }}"/></a></td>
                <td><a href="{{ action('MembersController@show',['id' => $birthday->id]) }}">{{ $birthday->name }}</a></td>
                <td>{{ $birthday->contact }}</td>
                <td>{{ $birthday->DOB }}</td>
            </tr>
        @empty
            <div class="tab-empty-panel font-size-24 color-grey-300">
                No Data
            </div>
        @endforelse
    </table>
</div>