<div>
    <input wire:model="search" type="text" placeholder="Search_By_Grade"/>

    <ul>
        @foreach($bloods as $blood)
            <li> {{$blood->name}} </li>
        @endforeach
    </ul>

</div>
