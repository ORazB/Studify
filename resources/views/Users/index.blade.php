<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Studify | Users List</title>
</head>

<body class="bg-gray-50">

  <section class="py-10">
    <div class="container mx-auto">

      @if(session()->has('username'))
      <p>Welcome, {{ session('username') }}</p>
      @else
      <p>Welcome, Guest</p>
      @endif

      <h1 class="text-2xl font-bold mb-6">Users List</h1>

      <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Username</th>
            <th class="border px-4 py-2">Role</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td class="border px-4 py-2">{{ $user->user_id }}</td>
            <td class="border px-4 py-2">{{ $user->username }}</td>
            <td class="border px-4 py-2">{{ $user->role }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>

</body>

</html>