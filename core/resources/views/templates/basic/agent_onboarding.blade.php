<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hochela Onboarding Wizard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .wizard-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wizard-card {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            opacity: 50; /* Start invisible */
            transform: translateY(20px); /* Start slightly below */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Transition effect */
        }

        .wizard-card.show {
            opacity: 1; /* Fully visible */
            transform: translateY(0); /* Move to original position */
        }

        .uploaded-image {
            width: 100px; /* Thumbnail size */
            margin: 5px;
            transition: transform 0.3s ease; /* Animation on hover */
        }

        .uploaded-image:hover {
            transform: scale(1.1); /* Slight zoom effect on hover */
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .step-heading {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .content-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .content-row {
                grid-template-columns: 1fr;
            }

            .options-container {
                grid-template-columns: 1fr;
            }

            .mobile-mt {
                margin-top: 100px;
            }
        }

        .content-left {
            text-align: left;
            font-size: 1.1rem;
        }

        .content-right {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .ol-images {
            list-style-type: decimal;
            padding-left: 20px;
        }

        .ol-images li {
            display: grid;
            grid-template-columns: 1fr auto;
            grid-template-rows: auto auto;
            margin-bottom: 2rem;
        }

        .ol-images h5 {
            grid-column: 1 / span 2;
            margin: 0;
        }

        .ol-images p {
            grid-column: 1;
            margin-left: 15px;
        }

        .ol-images img {
            grid-column: 2;
            width: 80px;
        }

        .next-button {
            text-align: right;
            margin-top: 2rem;
        }

        .next-button img {
            width: 50px;
            cursor: pointer;
        }

        .options-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .options-container-hr {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            gap: 20px;
        }

        .option {
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option:hover {
            transform: scale(1.05);
        }

        .option-hr {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
        }

        .option img {
            width: 60px;
            margin-bottom: 10px;
        }

        .option.selected {
            border-color: #007bff;
            background-color: #e7f1ff;
        }

        .slider-container {
            margin-top: 2rem;
            text-align: center;
        }

        .slider {
            width: 100%;
        }

        .amount-display {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .navigation-buttons button {
            padding: 10px 20px;
            font-size: 1.1rem;
        }

        /* Hide radio and checkbox inputs */
        input[type="radio"],
        input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            pointer-events: none; /* Prevent interactions with the hidden input */
        }

        .hr-text {
            text-align: start;
        }

        .search-input {
            margin-bottom: 1rem;
        }

        .map-container {
            position: relative;
            height: 400px;
            margin-bottom: 1rem;
        }

        .input-group .btn {
            width: 40px;
            height: 40px;
        }

        .input-group input {
            text-align: center;
            width: 60px;
        }

        .price-input {
            font-size: 2.2rem; /* Larger font size for visibility */
            border: none; /* Remove default border */
            padding-left: 40px; /* Padding for currency symbol */
            padding-right: 40px;
            text-align: center; /* Align text to the right */
            width: 250px; /* Fixed width for better alignment */
            height: 80px; /* Increase height for comfort */
        }

        .currency-symbol {
            font-size: 3rem; /* Match the size of the price input */
            position: absolute; /* Position it within the input */
            left: 10px; /* Align with the input */
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust to center */
        }

        .edit-icon {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: #0b5ed7;
            border-radius: 50%;
            padding: 5px;
        }

        .edit-icon img {
            width: 30px; /* Set appropriate size for edit icon */
        }

        .discount-options {
            display: flex;
            justify-content: center;
            gap: 20px; /* Space between cards */
            margin-top: 20px;
            flex-wrap: wrap; /* Allow cards to wrap on smaller screens */
        }

        .discount-card {
            border: 1px solid #007bff; /* Light blue border */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Inner spacing */
            background-color: white; /* White background for cards */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            width: 250px; /* Increased width for uniformity */
            text-align: center; /* Center text inside cards */
            transition: transform 0.3s; /* Smooth transition for hover effect */
            flex: 1; /* Allow card to grow and fill available space */
            min-width: 220px; /* Minimum width for smaller screens */
            cursor: pointer;
        }

        .discount-card:hover {
            transform: scale(1.05); /* Slight zoom effect on hover */
        }

        .discount-percentage {
            font-size: 2.5rem; /* Large font size for discount percentage */
            color: #007bff; /* Blue color for percentage */
            margin: 0; /* Remove margin */
        }

        .discount-title {
            font-size: 1.2rem; /* Title font size */
            margin: 10px 0; /* Top and bottom margin */
        }

        .discount-description {
            font-size: 1rem; /* Description font size */
            color: #666; /* Gray color for description */
        }

        @media (max-width: 768px) {
            .discount-card {
                width: 100%; /* Full width on small screens */
                max-width: 300px; /* Optional: cap max width for larger screens */
            }
        }

        .discount-card.selected {
            border-color: #007bff; /* Highlight border color */
            background-color: #e7f1ff; /* Highlight background color */
        }

        .content-row {
            display: flex; /* Use flexbox for layout */
            justify-content: space-between;
            align-items: flex-start; /* Align items to the start */
            margin-top: 20px;
        }

        .preview-box {
            border: 2px solid #ccc; /* Border style for the preview box */
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            margin-right: 20px; /* Space between the two sections */
            flex: 1; /* Allow the box to grow */
            background-color: #f8f9fa; /* Light grey background */
        }

        .preview-content {
            margin-top: 15px;
        }

        .image-placeholder {
            width: 100%;
            height: 200px; /* Adjust height as needed */
            background-color: #e9ecef; /* Light grey color */
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .image-placeholder::before {
            content: "Image Placeholder"; /* Placeholder text for the image */
            color: #6c757d; /* Grey text color */
            font-size: 1.2rem; /* Font size for placeholder text */
        }

        .next-steps {
            flex: 1; /* Allow the next steps content to grow */
            margin-left: 20px; /* Space between the two sections */
        }

        .next-steps h5 {
            margin-bottom: 10px;
        }

        .next-steps ol {
            padding-left: 15px; /* Add some padding to the list */
        }

        .id-card-image {
            width: 50px; /* Set the width of the ID card image */
            margin-top: 10px; /* Space between the list and the image */
            display: block; /* Ensure it appears as a block element */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .content-row {
                flex-direction: column; /* Stack vertically on mobile */
            }

            .preview-box,
            .next-steps {
                width: 100%; /* 100% width for both sections */
                margin-right: 0; /* Remove right margin */
                margin-left: 0; /* Remove left margin */
            }
        }
    </style>
</head>
<body>
<div class="logo">
    <img style="width: 200px" src="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}" alt="Hochela Logo"/>
</div>

<form class="mobile-mt" id="hochelaForm">
    <!-- Step 0 -->
    <div class="container wizard-container">
        <div class="wizard-card" id="step-0">
            <h2 class="step-heading">Welcome to Hochela!</h2>
            <div class="content-row">
                <div class="content-left">
                    <p>Welcome to Hochela! Showcase your property and help students find their perfect home.</p>
                </div>
                <div class="content-right">
                    <ol class="ol-images">
                        <li>
                            <h5>1. Tell Us About Your Property Type</h5>
                            <p>Booking options (entire place or room), location, and student capacity.</p>
                            <img src="{{ getImage(imagePath()['agents']['path'].'/agent-house.png') }}"
                                 alt="space icon"/>
                        </li>
                        <li>
                            <h5>2. Make it stand out</h5>
                            <p>Add 5 or more photos plus a title and description—we’ll help you out.</p>
                            <img src="{{ getImage(imagePath()['agents']['path'].'/agent-office.png') }}"
                                 alt="budget icon"/>
                        </li>
                        <li>
                            <h5>3. Finish up and publish</h5>
                            <p>Choose a starting price, verify a few details, then publish your listing.</p>
                            <img src="{{ getImage(imagePath()['agents']['path'].'/agent-woman-key.png') }}"
                                 alt="campus icon"/>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="next-button">
                <img src="{{ getImage(imagePath()['icons']['path'].'/Forward-btn.png') }}" alt="next button"
                     onclick="showStep(1)"/>
            </div>
        </div>
    </div>

    <!-- Step 1 -->
    <div class="container wizard-container" style="display: none" id="step-1">
        <div class="wizard-card">
            <h2 class="step-heading">Tell Us About Your Property Type</h2>
            <div class="content-row">
                <div class="content-left">
                    <p>
                        In this step, we’ll ask you which type of property you have and if students will book the entire
                        place or just a room. Then let us know the location and how many students can stay.
                    </p>
                </div>
                <div class="content-right text-center">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/agent-big-house.png') }}" alt="Step 1 Image"
                         class="img-fluid"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 0)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 2)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 2 -->
    <div class="container wizard-container" style="display: none" id="step-2">
        <div class="wizard-card">
            <h2 class="step-heading">What type of place are you looking for?</h2>
            <div class="options-container">
                <div class="option" id="option1" onclick="selectOption(1)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/hostel.svg') }}" alt="Hostel Icon"/>
                    <p>Hostel</p>
                    <input type="radio" name="place_type" value="Hostel"/>
                </div>
                <div class="option" id="option2" onclick="selectOption(2)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/apartment.svg') }}" alt="Apartment Icon"/>
                    <p>Apartment</p>
                    <input type="radio" name="place_type" value="Apartment"/>
                </div>
                <div class="option" id="option3" onclick="selectOption(3)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/self-contained.svg') }}"
                         alt="Self-Contained Icon"/>
                    <p>Self-Contained</p>
                    <input type="radio" name="place_type" value="Self-Contained"/>
                </div>
                <div class="option" id="option4" onclick="selectOption(4)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/single.svg') }}" alt="Single Room Icon"/>
                    <p>Single Room</p>
                    <input type="radio" name="place_type" value="Single Room"/>
                </div>
                <div class="option" id="option5" onclick="selectOption(5)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/two-beds.svg') }}"
                         alt="Two Bedroom Apartment Icon"/>
                    <p>2 Bedroom Apartment</p>
                    <input type="radio" name="place_type" value="2 Bedroom Flat"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 1)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 3)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 3 -->
    <div class="container wizard-container" style="display: none" id="step-3">
        <div class="wizard-card">
            <h2 class="step-heading">What type of property will the students have?</h2>
            <div class="options-container-hr">
                <div class="option option-hr" id="option6" onclick="selectOption(6)">
                    <div class="hr-text">
                        <h3>The entire place</h3>
                        <p>Students will have the entire place to themselves</p>
                    </div>
                    <img src="{{ getImage(imagePath()['agents']['path'].'/home-screen.png') }}"
                         alt="the entire placen"/>
                    <input type="checkbox" name="amenities" value="Good Internet Service"/>
                </div>
                <div class="option option-hr" id="option7" onclick="selectOption(7)">
                    <div class="hr-text">
                        <h3>Just a room</h3>
                        <p>Student has their own room in the house, plus shared spaces</p>
                    </div>
                    <img src="{{ getImage(imagePath()['agents']['path'].'/door-closed.png') }}" alt="room"/>
                    <input type="checkbox" name="amenities" value="TV"/>
                </div>
                <div class="option option-hr" id="option8" onclick="selectOption(8)">
                    <div class="hr-text">
                        <h3>A shared room</h3>
                        <p>Students sleep in a room or common area that may be shared with you or others</p>
                    </div>
                    <img src="{{ getImage(imagePath()['agents']['path'].'/two-beds.png') }}" alt="Kitchen Icon"/>
                    <input type="checkbox" name="amenities" value="Kitchen"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 2)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 4)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 4 -->
    <div class="container wizard-container" style="display: none" id="step-4">
        <div class="wizard-card">
            <h2 class="step-heading">What type of setup best describes your property?</h2>
            <div class="options-container-hr">
                <div class="option option-hr" id="option9" onclick="selectOption(9)">
                    <div class="hr-text">
                        <h3>Furnished</h3>
                        <p>Fully equipped with all essential furniture for a hassle-free move-in.</p>
                    </div>
                    <img src="{{ getImage(imagePath()['agents']['path'].'/home-screen.png') }}"
                         alt="the entire placen"/>
                    <input type="checkbox" name="property-setup" value="Good Internet Service"/>
                </div>
                <div class="option option-hr" id="option10" onclick="selectOption(10)">
                    <div class="hr-text">
                        <h3>Lightly Furnished</h3>
                        <p>Includes key pieces like a bed and desk, allowing for some personal touches.</p>
                    </div>
                    <img src="{{ getImage(imagePath()['agents']['path'].'/single-bed.png') }}" alt="room"/>
                    <input type="checkbox" name="property-setup" value="TV"/>
                </div>
                <div class="option option-hr" id="option11" onclick="selectOption(11)">
                    <div class="hr-text">
                        <h3>Unfurnished</h3>
                        <p>An empty space for you to fill with your own furniture and style.</p>
                    </div>
                    <img src="{{ getImage(imagePath()['agents']['path'].'/unchecked-box.png') }}" alt="Kitchen Icon"/>
                    <input type="checkbox" name="property-setup" value="Kitchen"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 3)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 5)">Next</button>
            </div>
        </div>
    </div>
    <!-- Step 5 -->
    <div class="container wizard-container" style="display: none" id="step-5">
        <div class="wizard-card">
            <h2 class="step-heading">Where’s Your Property Located?</h2>
            <p>Your address is only shared with guests after they’ve made a reservation.</p>
            <input type="hidden" name="google_link" id="input_map_embed" value="">
            <input type="text" name="location" id="place_location" class="form-control search-input"
                   placeholder="Search..."/>
            <div class="map-container">
                <iframe id="google_iframe"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434508753!2d144.95373531531628!3d-37.8172099797515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f12cf0f%3A0x5045675218ceed1!2sYour%20Location!5e0!3m2!1sen!2sus!4v1632680296798!5m2!1sen!2sus"
                        width="100%"
                        height="400"
                        style="border: 0"
                        allowfullscreen=""
                        loading="lazy"
                ></iframe>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 4)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 6)">Next</button>
            </div>
        </div>
    </div>
    <!-- Step 6 -->
    <div class="container wizard-container" style="display: none" id="step-6">
        <div class="wizard-card">
            <h2 class="step-heading">Share Some Basics About Your Property</h2>
            <p class="step-description text-center">You’ll add more details later, like bed types.</p>

            <div style="margin-bottom: -10px" class="input-group justify-content-between">
                <label for="students" class="form-label me-2">Students</label>
                <div style="display: flex">
                    <img class="mr-3" style="cursor: pointer; margin-right: 0px" onclick="changeValue('students', -1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Minus.png') }}" alt=""/>
                    <input style="border: none; padding: 0" type="number" class="form-control" id="students" value="0"
                           readonly/>
                    <img style="cursor: pointer; margin-left: -12px" onclick="changeValue('students', 1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Add.png') }}" alt=""/>
                </div>
            </div>
            <hr/>
            <div style="margin-bottom: -10px; margin-top: 50px" class="input-group justify-content-between">
                <label for="bedrooms" class="form-label me-2">Bedrooms</label>
                <div style="display: flex">
                    <img class="mr-3" style="cursor: pointer; margin-right: 0px" onclick="changeValue('bedrooms', -1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Minus.png') }}" alt=""/>
                    <input name="available_rooms" style="border: none; padding: 0" type="number" class="form-control"
                           id="bedrooms" value="0"
                           readonly/>
                    <img style="cursor: pointer; margin-left: -12px" onclick="changeValue('bedrooms', 1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Add.png') }}" alt=""/>
                </div>
            </div>
            <hr/>
            <div style="margin-bottom: -10px; margin-top: 50px" class="input-group justify-content-between">
                <label for="bathrooms" class="form-label me-2">Bathrooms</label>
                <div style="display: flex">
                    <img class="mr-3" style="cursor: pointer; margin-right: 0px" onclick="changeValue('bathrooms', -1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Minus.png') }}" alt=""/>
                    <input style="border: none; padding: 0" type="number" class="form-control" id="bathrooms" value="0"
                           readonly/>
                    <img style="cursor: pointer; margin-left: -12px" onclick="changeValue('bathrooms', 1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Add.png') }}" alt=""/>
                </div>
            </div>
            <hr/>
            <div style="margin-bottom: -10px; margin-top: 50px" class="input-group justify-content-between">
                <label for="beds" class="form-label me-2">Beds</label>
                <div style="display: flex">
                    <img class="mr-3" style="cursor: pointer; margin-right: 0px" onclick="changeValue('beds', -1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Minus.png') }}" alt=""/>
                    <input style="border: none; padding: 0" type="number" class="form-control" id="beds" value="0"
                           readonly/>
                    <img style="cursor: pointer; margin-left: -12px" onclick="changeValue('beds', 1)"
                         src="{{ getImage(imagePath()['agents']['path'].'/Add.png') }}" alt=""/>
                </div>
            </div>
            <hr/>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 5)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 7)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 7 -->
    <div class="container wizard-container" style="display: none" id="step-7">
        <div class="wizard-card">
            <h2 class="step-heading">Make your Property Stand Out</h2>
            <div class="content-row">
                <div class="content-left">
                    <p>In this step, you’ll add some of the amenities your property offers, plus 5 or more photos. Then,
                        you’ll create a title and description.</p>
                </div>
                <div class="content-right text-center">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/kitchen-interior.png') }}" alt="Step 1 Image"
                         class="img-fluid"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 6)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 8)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 8 -->
    <div class="container wizard-container" style="display: none" id="step-8">
        <div class="wizard-card">
            <h2 class="step-heading">What about these student favourites?</h2>
            <div class="options-container">
                <div class="option" id="option12" onclick="selectOption(12)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/internet.svg') }}"
                         alt="Good Internet Service Icon"/>
                    <p>Good Internet Service</p>
                    <input type="checkbox" name="extra-features" value="Good Internet Service"/>
                </div>
                <div class="option" id="option13" onclick="selectOption(13)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/tv.svg') }}" alt="TV Icon"/>
                    <p>TV</p>
                    <input type="checkbox" name="extra-features" value="TV"/>
                </div>
                <div class="option" id="option14" onclick="selectOption(14)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/kitchen.svg') }}" alt="Kitchen Icon"/>
                    <p>Kitchen</p>
                    <input type="checkbox" name="extra-features" value="Kitchen"/>
                </div>
                <div class="option" id="option15" onclick="selectOption(15)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/bathroom.svg') }}" alt="Bathroom Icon"/>
                    <p>Functional Bathroom</p>
                    <input type="checkbox" name="extra-features" value="Functional Bathroom"/>
                </div>
                <div class="option" id="option16" onclick="selectOption(16)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/parking.svg') }}" alt="Parking Icon"/>
                    <p>Parking</p>
                    <input type="checkbox" name="extra-features" value="Parking"/>
                </div>
                <div class="option" id="option17" onclick="selectOption(17)">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/study.svg') }}" alt="Study Space Icon"/>
                    <p>Study Space</p>
                    <input type="checkbox" name="extra-features" value="Study Space"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 7)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 9)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 9 -->
    <div class="container wizard-container" style="display: none" id="step-9">
        <div class="wizard-card">
            <h2 class="step-heading">Add some photos/videos of your house</h2>
            <p class="text-center">You’ll need 5 photos to get started. You can add more or make changes later.</p>
            <div class="upload-section text-center">
                <div class="upload-box border-dashed p-4 mb-4" style="border: 2px dashed #007bff; border-radius: 8px">
                    <input type="file" name="file-upload[]" id="file-upload" multiple accept="image/*" class="d-none"
                           onchange="handleFileUpload()"/>

                    <label for="file-upload" class="upload-label" style="cursor: pointer">
                        <img src="{{ getImage(imagePath()['agents']['path'].'/document-upload.png') }}"
                             alt="Upload Icon" style="width: 50px"/>
                        <div>Drag and Drop file or <span class="text-primary">Choose File</span></div>
                    </label>
                    <div id="uploadProgress" class="progress mt-2" style="display: none">
                        <div class="progress-bar" role="progressbar" style="width: 0%" id="progressBar"
                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                        </div>
                    </div>
                </div>
            </div>
            <div id="uploadedImages" class="d-flex flex-wrap justify-content-center"></div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 8)">Back</button>
                <button class="btn btn-primary" id="nextButton" onclick="navigateToStep(event, 10)" disabled>Next
                </button>
            </div>
        </div>
    </div>

    <!-- Step 10 -->
    <div class="container wizard-container" style="display: none" id="step-10">
        <div class="wizard-card">
            <h2 class="step-heading">Now, let's give your house a title</h2>
            <p>Short titles work best. Have fun with it—you can always change it later.</p>
            <div class="mb-3">
                <input type="text" name="name" class="form-control" id="houseTitle" placeholder="eg Godswill House"
                       maxlength="32"
                       oninput="updateCharCount()"/>
                <div class="form-text text-end" id="charCount">0/32</div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 9)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 11)">Next</button>
            </div>
        </div>
    </div>

    <script>
        function updateCharCount() {
            const titleInput = document.getElementById("houseTitle");
            const charCount = document.getElementById("charCount");
            charCount.textContent = `${titleInput.value.length}/32`;
        }
    </script>

    <!-- Step 11 -->
    <div class="container wizard-container" style="display: none" id="step-11">
        <div class="wizard-card">
            <h2 class="step-heading">Next, Let's Describe Your Property</h2>
            <p>Choose up to 2 highlights. We'll use these to get your description started.</p>
            <div class="options-container">
                <div class="option" id="highlight-peaceful" onclick="selectHighlight('Peaceful')">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/Peace Pigeon.png') }}" alt="Peaceful Icon"/>
                    <p>Peaceful</p>
                    <input type="checkbox" name="property-highlight" value="Peaceful" style="display: none"/>
                </div>
                <div class="option" id="highlight-unique" onclick="selectHighlight('Unique')">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/Sparkling Diamond.png') }}"
                         alt="Unique Icon"/>
                    <p>Unique</p>
                    <input type="checkbox" name="property-highlight" value="Unique" style="display: none"/>
                </div>
                <div class="option" id="highlight-spacious" onclick="selectHighlight('Spacious')">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/People.png') }}" alt="Spacious Icon"/>
                    <p>Spacious</p>
                    <input type="checkbox" name="property-highlight" value="Spacious" style="display: none"/>
                </div>
                <div class="option" id="highlight-stylish" onclick="selectHighlight('Stylish')">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/Vintage Glasses.png') }}" alt="Stylish Icon"/>
                    <p>Stylish</p>
                    <input type="checkbox" name="property-highlight" value="Stylish" style="display: none"/>
                </div>
                <div class="option" id="highlight-central" onclick="selectHighlight('Central')">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/City.png') }}" alt="Central Icon"/>
                    <p>Central</p>
                    <input type="checkbox" name="property-highlight" value="Central" style="display: none"/>
                </div>
                <div class="option" id="highlight-student" onclick="selectHighlight('student')">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/Graduation Cap.png') }}"
                         alt="Student-friendly community Icon"/>
                    <p>Student-friendly community</p>
                    <input type="checkbox" name="property-highlight" value="Student-friendly-community"
                           style="display: none"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 10)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 12)">Next</button>
            </div>
        </div>
    </div>

    <script>
        let selectedHighlights = [];

        function selectHighlight(highlight) {
            const optionElement = document.getElementById(`highlight-${highlight.toLowerCase().replace(/ /g, "-")}`);
            const checkbox = optionElement.querySelector('input[type="checkbox"]');

            if (selectedHighlights.includes(highlight)) {
                selectedHighlights = selectedHighlights.filter((h) => h !== highlight);
                checkbox.checked = false;
                optionElement.classList.remove("selected"); // Remove selected class
            } else if (selectedHighlights.length < 2) {
                selectedHighlights.push(highlight);
                checkbox.checked = true;
                optionElement.classList.add("selected"); // Add selected class
            } else {
                alert("You can only select up to 2 highlights.");
            }
        }
    </script>

    <!-- Step 12 -->
    <div class="container wizard-container" style="display: none" id="step-12">
        <div class="wizard-card">
            <h2 class="step-heading">Create your description</h2>
            <p class="text-center">Share what makes your property special.</p>
            <div class="mb-3">
            <textarea
                class="form-control"
                id="houseDesc"
                name="description"
                placeholder="eg Comfortable student accommodation close to OAU and the market."
                maxlength="500"
                rows="5"
                oninput="updateCharCountDesc()"
                onkeydown="preventEnter(event)"
            ></textarea>
                <div class="form-text text-end" id="charCountDesc">0/500</div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 11)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 13)">Next</button>
            </div>
        </div>
    </div>

    <script>
        function updateCharCountDesc() {
            const titleInput = document.getElementById("houseDesc");
            const charCount = document.getElementById("charCountDesc");
            charCount.textContent = `${titleInput.value.length}/500`;
        }

        function preventEnter(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent form submission
            }
        }
    </script>

    <!-- Step 13 -->
    <div class="container wizard-container" style="display: none" id="step-13">
        <div class="wizard-card">
            <h2 class="step-heading">Finish up and publish</h2>
            <div class="content-row">
                <div class="content-left">
                    <p class="text-center">
                        Finally, you’ll choose if you'd like to start with an experienced guest, then you'll set your
                        nightly price. Answer a few quick questions and publish when you're ready.
                    </p>
                </div>
                <div class="content-right text-center">
                    <img src="{{ getImage(imagePath()['agents']['path'].'/Bedroom for small children.png') }}"
                         alt="Step 1 Image" class="img-fluid"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 12)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 14)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 14 -->
    <div class="container wizard-container" style="display: none" id="step-14">
        <div class="wizard-card">
            <h2 class="step-heading">Choose who to welcome for your first reservation</h2>
            <p class="text-center">After your first guest, anyone can book your place.</p>
            <div class="options-container-hr">
                <div class="option option-hr" id="option18" onclick="selectOption(18)">
                    <div class="hr-text">
                        <h3>Any Student</h3>
                        <p>Get reservations faster when you welcome any student from the Hochela community.</p>
                    </div>
                    <input type="checkbox" name="who_can_book" value="Good Internet Service"/>
                </div>
                <div class="option option-hr" id="option19" onclick="selectOption(19)">
                    <div class="hr-text">
                        <h3>An experienced Student (2nd year and above)</h3>
                        <p>For your first guest, welcome someone with a good track record on Hochela.</p>
                    </div>
                    <input type="checkbox" name="who_can_book" value="secondyearplus"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 13)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 15)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 15 -->
    <div class="container wizard-container" style="display: none" id="step-15">
        <div class="wizard-card text-center">
            <h2 class="step-heading">Now, set your price</h2>
            <p>You can change it anytime.</p>
            <div class="mb-4 position-relative" style="display: inline-block">
                <span class="currency-symbol">₦</span>
                <input type="text" name="property_amount" class="form-control price-input" id="propertyPrice"
                       value="100,000" oninput="formatPrice()" onkeydown="preventEnter(event)"/>
                <span class="edit-icon" onclick="editPrice()">
              <img src="{{ getImage(imagePath()['agents']['path'].'/Edit.png') }}" alt="Edit"/>
            </span>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 14)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 16)">Next</button>
            </div>
        </div>
    </div>
    <script>
        function formatPrice() {
            const priceInput = document.getElementById("propertyPrice");
            let value = priceInput.value.replace(/[^0-9]/g, ""); // Remove non-numeric characters
            value = new Intl.NumberFormat().format(value); // Format with commas
            priceInput.value = value; // Set formatted value back to input
        }

        function preventEnter(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent default Enter key action
            }
        }

        function editPrice() {
            const priceInput = document.getElementById("propertyPrice");
            priceInput.removeAttribute("readonly"); // Allow editing
            priceInput.focus(); // Focus on the input
        }
    </script>
    <!-- Step 16 -->
    <div class="container wizard-container" style="display: none" id="step-16">
        <div class="wizard-card">
            <h2 class="step-heading">Add Discounts</h2>
            <p>Help your place stand out to get booked faster and earn your first reviews</p>
            <div class="discount-options">
                <div class="discount-card" onclick="selectDiscount('new-listing')" id="new-listing-card">
                    <input type="radio" name="discount" value="20" style="display: none" id="new-listing"/>
                    <p class="discount-percentage">20%</p>
                    <h5 class="discount-title">New Listing Promotion</h5>
                    <p class="discount-description">Offer 20% off your first 3 bookings</p>
                </div>
                <div class="discount-card" onclick="selectDiscount('hoch-discount')" id="hoch-discount-card">
                    <input type="radio" name="discount" value="10" style="display: none" id="hoch-discount"/>
                    <p class="discount-percentage">10%</p>
                    <h5 class="discount-title">Hochela's Discount</h5>
                    <p class="discount-description">First-time renters get 10%</p>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 15)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 17)">Next</button>
            </div>
        </div>
    </div>
    <!-- Step 17 -->
    <div class="container wizard-container" style="display: none" id="step-17">
        <div class="wizard-card">
            <h2 class="step-heading">Review Your Listing</h2>
            <p>Here’s what students will see. Make sure everything looks good!</p>
            <div class="content-row">
                <div class="preview-box">
                    <div class="preview-content">
                        <img src="" alt="Accommodation Preview" id="previewImage"
                             style="display: block; width: 100%; height: auto;"/>
                        <h5 id="accommodationName">Accommodation Name</h5>
                        <p id="accommodationPrice">Price</p>
                    </div>
                </div>
                <div class="next-steps">
                    <h5>What’s Next?</h5>
                    <ol class="ol-images">
                        <li>
                            <h5>1. Confirm Your Identity</h5>
                            <p>Upload your NIN card to confirm your identity.</p>
                            <img src="<?php echo e(getImage(imagePath()['agents']['path'].'/agent-house.png')); ?>"
                                 alt="space icon"/>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 16)">Back</button>
                <button class="btn btn-primary" onclick="submitForm()">Get Started</button>
            </div>
        </div>
    </div>
</form>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Form Wizard JS -->
<script>
    function showStep(step) {
        if (step === 16) {
            // Update the accommodation name and price
            const accommodationName = document.getElementById("accommodationName");
            const accommodationPrice = document.getElementById("accommodationPrice");

            const houseTitle = document.getElementById("houseTitle").value; // Get the title from Step 10
            const propertyPrice = document.getElementById("propertyPrice").value; // Get the price from Step 15

            accommodationName.innerText = houseTitle; // Update name
            accommodationPrice.innerText = `₦${propertyPrice}`; // Update price
        }
        const steps = document.querySelectorAll(".wizard-container");
        steps.forEach((el, index) => {
            el.style.display = index === step ? "flex" : "none"; // Show the selected step
            if (index === step) {
                const wizardCard = el.querySelector(".wizard-card");
                wizardCard.classList.add("show"); // Add animation class
                setTimeout(() => {
                    wizardCard.classList.remove("show"); // Remove class after animation
                }, 500); // Match the duration of the animation
            }
        });
    }

    function updateValue(val) {
        document.getElementById("rentValue").innerText = val;
        document.getElementById("rentInput").value = val; // Update the hidden input with the selected value
    }

    function submitForm() {
        event.preventDefault(); // Prevent the default form submission

        // Create a FormData object from the form
        const formData = new FormData(document.getElementById("hochelaForm"));

        // Log FormData to the console
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Send FormData to the Laravel route
        fetch('/agent-onboarding', { // Make sure to use the correct route path
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Ensure you include the CSRF token for Laravel
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json(); // Assuming Laravel returns a JSON response
            })
            .then(data => {
                // Handle success response
                console.log('Success:', data);
                // alert('Form submitted successfully!');
                window.location.href = '{{ route('owner.dashboard') }}';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


    function selectOption(optionId) {
        const options = document.querySelectorAll(".option");
        options.forEach((option) => {
            option.classList.remove("selected");
        });
        const selectedOption = document.getElementById("option" + optionId);
        selectedOption.classList.add("selected");

        // Check the corresponding radio button or checkbox
        const radio = selectedOption.querySelector('input[type="radio"]');
        if (radio) {
            radio.checked = true; // Automatically select the radio button
        }

        const checkbox = selectedOption.querySelector('input[type="checkbox"]');
        if (checkbox) {
            checkbox.checked = !checkbox.checked; // Toggle the checkbox
        }
    }

    function navigateToStep(event, step) {
        event.preventDefault(); // Prevent form submission
        const currentStep = step - 1; // Adjust to check current step
        if (validateStep(currentStep)) {
            showStep(step); // Show the requested step
        } else {
            alert("Please fill in all required fields before proceeding.");
        }
    }

    function changeValue(id, delta) {
        const input = document.getElementById(id);
        let currentValue = parseInt(input.value);
        currentValue += delta;
        input.value = Math.max(currentValue, 0); // Ensure value doesn't go below 0
    }

    function selectDiscount(discountType) {
        // Deselect all discount cards
        const discountCards = document.querySelectorAll(".discount-card");
        discountCards.forEach((card) => {
            card.classList.remove("selected");
        });

        // Select the clicked discount card
        const selectedCard = document.getElementById(discountType + "-card");
        selectedCard.classList.add("selected");

        // Check the corresponding radio button
        const radioButton = document.getElementById(discountType);
        if (radioButton) {
            radioButton.checked = true; // Select the radio button
        }
    }

    function validateStep(step) {
        switch (step) {
            case 2: // Step 2: Check if any place type is selected
                const placeTypeSelected = Array.from(document.querySelectorAll('input[name="place_type"]')).some((input) => input.checked);
                return placeTypeSelected;

            case 3: // Step 3: Check if any property type is selected
                const propertyTypeSelected = Array.from(document.querySelectorAll('input[name="amenities"]')).some((input) => input.checked);
                return propertyTypeSelected;

            case 4: // Step 4: Check if any setup type is selected
                const setupTypeSelected = Array.from(document.querySelectorAll('input[name="property-setup"]')).some((input) => input.checked);
                return setupTypeSelected;

            case 5:
                const location = document.getElementById("place_location").value.trim();
                return location.length > 0;

            case 6: // Step 6: Check if numbers for students, bedrooms, bathrooms, and beds are filled
                const studentsValue = document.getElementById("students").value;
                const bedroomsValue = document.getElementById("bedrooms").value;
                const bathroomsValue = document.getElementById("bathrooms").value;
                const bedsValue = document.getElementById("beds").value;
                return studentsValue > 0 || bedroomsValue > 0 || bathroomsValue > 0 || bedsValue > 0;
            case 8: // Step 8: Check if any property type is selected
                const extraFeatures = Array.from(document.querySelectorAll('input[name="extra-features"]')).some((input) => input.checked);
                return extraFeatures;

            case 10: // Step 10: Check if the house title is filled
                const houseTitle = document.getElementById("houseTitle").value.trim();
                return houseTitle.length > 0;

            case 11: // Step 11: Check if at least one highlight is selected
                const highlightSelected = Array.from(document.querySelectorAll('input[name="property-highlight"]')).some((input) => input.checked);
                return highlightSelected;

            case 12: // Step 12: Check if the description is filled
                const houseDesc = document.getElementById("houseDesc").value.trim();
                return houseDesc.length > 2;
            case 14: // Step 14: Check if any property type is selected
                const whoCanBook = Array.from(document.querySelectorAll('input[name="who_can_book"]')).some((input) => input.checked);
                return whoCanBook;

            case 15: // Step 15: Check if price is filled
                const propertyPrice = document.getElementById("propertyPrice").value.replace(/[^0-9]/g, "");
                return propertyPrice.length > 0;

            case 16: // Step 16: Check if any discount option is selected
                const discountSelected = Array.from(document.querySelectorAll('input[name="discount"]')).some((input) => input.checked);
                return discountSelected;

            default:
                return true; // Allow navigation for other steps
        }
    }

    let uploadedFiles = []; // Array to hold uploaded file names

    function handleFileUpload() {
        const fileInput = document.getElementById("file-upload");
        const uploadedImages = document.getElementById("uploadedImages");
        uploadedImages.innerHTML = ""; // Clear previous images

        const files = fileInput.files;
        // Check if at least 5 files are selected
        if (files.length < 2) {
            alert("Please upload at least 2 images.");
            return;
        }

        // Loop through selected files and create image previews
        Array.from(files).forEach(file => {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.className = "uploaded-image"; // Add class for styling
            uploadedImages.appendChild(img);
            uploadedFiles.push(file); // Store uploaded file in the array
        });

        // Set the preview image to the first uploaded image
        const previewImage = document.getElementById("previewImage");
        previewImage.src = URL.createObjectURL(uploadedFiles[0]);

        // Enable the next button if at least 5 images are uploaded
        document.getElementById("nextButton").disabled = false;
    }

</script>
<script>
    // Initialize and add the map
    function initAutocomplete() {
        // Ensure the input element exists before initializing autocomplete
        var input = document.getElementById('place_location');
        if (!input) {
            console.error('Input element not found');
            return;
        }

        // Create the autocomplete object, restricting the search to geographical location types.
        var autocomplete = new google.maps.places.Autocomplete(input, {types: ['geocode']});

        console.log('Autocomplete initialized');

        // Add event listener for the place_changed event
        autocomplete.addListener('place_changed', function () {
            fillInAddress(autocomplete);
        });
    }

    function fillInAddress(autocomplete) {
        var place = autocomplete.getPlace();

        if (place.geometry) {
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var embedUrl = getEmbedUrl(lat, lng);
            console.log('Embedded URL:', embedUrl);

            // Display the embedded map in an iframe or use the URL as needed
            document.getElementById('input_map_embed').value = embedUrl;
            document.getElementById('google_iframe').src = embedUrl;
        }
    }

    function getEmbedUrl(lat, lng) {
        return `https://www.google.com/maps/embed/v1/view?key={{env('GOOGLE_PLACE_API_KEY')}}&center=${lat},${lng}&zoom=14&maptype=roadmap`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Load the Google Maps script asynchronously
        var script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_PLACE_API_KEY')}}&libraries=places&callback=initAutocomplete';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    });
</script>
</body>
</html>
