<x-master-layout>

    <h3 class="my-3">Notiification</h3>

    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $item)

                    <tr @if($item->read_at) class="text-muted" @endif>
                        <td>
                            @if($item->type == 'App\Notifications\PostResponse')

                                {{ $item->data['content'] }}

                            @endif
                        </td>
                        <td> {{ $item->created_at }} </td>
                        <td>
                            @if(! $item->read_at)
                            <a href="/notification/read/{{ $item->id }}">Mark as read</a>

                            @endif
                        </td>
                    </tr>
                     
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-master-layout>