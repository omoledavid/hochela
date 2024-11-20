<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">We value your feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="feedbackForm">
                    <!-- Star Rating -->
                    <div class="form-group">
                        <label for="rating">Rate us:</label>
                        <div id="starRating" class="d-flex">
                            <!-- Star icons (Font Awesome) -->
                            <span class="fa fa-star" data-rating="1"></span>
                            <span class="fa fa-star" data-rating="2"></span>
                            <span class="fa fa-star" data-rating="3"></span>
                            <span class="fa fa-star" data-rating="4"></span>
                            <span class="fa fa-star" data-rating="5"></span>
                        </div>
                    </div>

                    <!-- Feedback Text -->
                    <div class="form-group">
                        <label for="feedbackText">Your feedback:</label>
                        <textarea class="form-control" id="feedbackText" rows="3"
                                  placeholder="Write your feedback here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal" aria-label="Close">Close
                </button>
                <button type="button" class="btn btn-primary" id="submitFeedback">Submit Feedback</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Show the feedback modal after 3 minutes (180000 milliseconds)
        setTimeout(function () {
            $("#feedbackModal").modal("show");
        }, 180000); // 3 minutes

        $(".close").on("click", function () {
            $("#feedbackModal").modal("hide");
        });


        // Star Rating Logic
        $("#starRating .fa-star").on("click", function () {
            const rating = $(this).data("rating");
            $("#starRating .fa-star").removeClass("selected");
            $(this).prevAll().addBack().addClass("selected"); // Highlight selected stars
            $("#feedbackForm").data("rating", rating); // Store rating in form data
        });

        // Submit Feedback
        $("#submitFeedback").on("click", function () {
            const rating = $("#feedbackForm").data("rating");
            const feedbackText = $("#feedbackText").val();

            if (!rating) {
                alert("Please provide a star rating.");
                return;
            }

            // Send feedback to Laravel route
            $.ajax({
                url: '{{ route("feedback.store") }}',
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token for security
                    rating: rating,
                    feedback: feedbackText,
                },
                success: function (response) {
                    alert(response.message);
                    $("#feedbackModal").modal("hide");
                    $("#feedbackForm").trigger("reset");
                    $("#starRating .fa-star").removeClass("selected");
                },
                error: function (xhr) {
                    alert("There was an error submitting your feedback. Please try again.");
                },
            });
        });
    });
</script>
