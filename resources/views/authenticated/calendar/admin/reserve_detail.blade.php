<x-sidebar>
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p>{{ \Carbon\Carbon::parse($date)->format('Y年m月d日') }} {{ $part }}部</p>
    <div class="h-75 border">
      <table class="table w-100">
        <thead>
          <tr class="text-center" style="background:#29ABE2; color:#fff;">
            <th class="w-25">ID</th>
            <th class="w-25">名前</th>
            <th class="w-25">場所</th>
          </tr>
        </thead>
        <tbody>
          @foreach($reservePersons as $reservePerson)
            @foreach($reservePerson->users as $user)
              <tr class="text-center" style="background: {{ $loop->iteration % 2 === 0 ? '#e0f4fc' : '#ffffff' }};">
                <td>{{ $user->id }}</td>
                <td>{{ $user->over_name }}{{ $user->under_name }}</td>
                <td>リモート</td>
              </tr>
            @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</x-sidebar>
