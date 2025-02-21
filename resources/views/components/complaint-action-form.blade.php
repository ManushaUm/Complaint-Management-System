<div class="mt-4">



    <form action="{{route('add-comment' , ['id' => $id])}}" method="POST">

        @csrf

        <div class="mb-3">
            <label for="commentmessage-input" class="form-label">Solution <span class="text-red-500">*</span></label>
            <textarea class="form-control" id="commentmessage-input" placeholder="Your Solution..." rows="3" name="commentmessage-input"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="solved" name="solved">
                        <label class="form-check-label" for="solved">Solved the issue</label>
                    </div>
                </div>
            </div>
        </div>


        <div class="text-end">
            <button type="submit" class="btn btn-success w-sm">Submit</button>
        </div>
    </form>
</div>