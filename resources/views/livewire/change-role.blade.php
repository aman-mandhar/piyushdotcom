<div class="p-4">
    <h2 class="text-xl font-semibold mb-4">Change User Role</h2>

    @if (session()->has('success'))
        <div class="text-green-700 bg-green-100 border border-green-400 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <input 
        type="text" 
        wire:model.debounce.500ms="search" 
        class="w-full border border-gray-300 rounded px-4 py-2 mb-4" 
        placeholder="Search user by name, email, or mobile"
    >
    <pre class="text-xs bg-gray-100 p-2 rounded">{{ json_encode($users, JSON_PRETTY_PRINT) }}</pre>
    

    @if (!empty($users))
        <table class="w-full table-auto border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Mobile</th>
                    <th class="border px-4 py-2">Current Role</th>
                    <th class="border px-4 py-2">Change Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->mobile_number }}</td>
                        <td class="border px-4 py-2">{{ $user->role->name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">
                            <select 
                                wire:change="changeRole({{ $user->id }}, $event.target.value)"
                                class="border px-2 py-1 rounded"
                            >
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($user->role_id == $role->id) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(strlen($search) >= 2)
        <div class="text-gray-500 mt-4">No matching users found.</div>
    @endif
</div>
