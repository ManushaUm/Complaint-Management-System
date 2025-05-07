<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <form action="{{route('add-comment' , ['id' => $id])}}" method="POST" class="space-y-6">
        @csrf
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="commentmessage-input" class="block text-sm font-medium text-gray-700">
                    Solution <span class="text-red-500">*</span>
                </label>
            </div>
            <textarea
                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors"
                id="commentmessage-input"
                placeholder="Enter your solution here..."
                rows="4"
                name="commentmessage-input"></textarea>
        </div>

        <div class="flex items-center">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" id="solved" name="solved" class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-700">Solved the issue</span>
            </label>
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Submit
            </button>
        </div>
    </form>
</div>