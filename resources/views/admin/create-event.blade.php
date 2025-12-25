<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="col-span-2">
            <label class="block text-gray-700 font-bold mb-2">Event Title</label>
            <input type="text" name="title" class="w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Category</label>
            <select name="category" class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="Conference">Conference</option>
                <option value="Workshop">Workshop</option>
                <option value="Sports">Sports</option>
                <option value="Cultural">Cultural</option>
                <option value="Music">Music</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Venue</label>
            <input type="text" name="venue" placeholder="e.g. Main Auditorium" class="w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Event Date</label>
            <input type="date" name="event_date" class="w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Event Time</label>
            <input type="time" name="event_time" class="w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Ticket Price (RM)</label>
            <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label class="block text-gray-700 font-bold mb-2">Total Tickets</label>
            <input type="number" name="total_tickets" class="w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="col-span-2">
            <label class="block text-gray-700 font-bold mb-2">Event Image (Optional)</label>
            <input type="file" name="image" class="w-full border border-gray-300 rounded-md p-2">
        </div>

        <div class="col-span-2">
            <label class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

    </div>

    <div class="flex justify-end mt-6">
        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded shadow-lg transition duration-150 ease-in-out">
            Save Event
        </button>
    </div>

</form>