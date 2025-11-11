
<x-app-layout>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-4 text-green-700">🏋️ Admin Control Panel: Overview</h1>
                <p class="mb-4">Welcome Vinny! Quick metrics for your supplement store operations.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <a href="{{ route('admin.orders.index') }}" class="block p-4 border rounded-lg bg-yellow-50 hover:bg-yellow-100 text-yellow-800 shadow">
                        <h2 class="text-xl font-semibold">Orders Pending</h2>
                        <p class="text-3xl font-extrabold">12</p>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="block p-4 border rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-800 shadow">
                        <h2 class="text-xl font-semibold">Total Products</h2>
                        <p class="text-3xl font-extrabold">45</p>
                    </a>
                    <a href="#" class="block p-4 border rounded-lg bg-red-50 hover:bg-red-100 text-red-800 shadow">
                        <h2 class="text-xl font-semibold">Low Stock Items</h2>
                        <p class="text-3xl font-extrabold">3</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>