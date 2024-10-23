<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
          sizes="16x16">
    <link rel="apple-touch-icon" type="image/png"
          href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
          sizes="180x180">
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

        .option {
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
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
    </style>
</head>
<body>
<div class="logo">
    <img style="width: 200px" src="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}" alt="logo">
</div>

<form class="mobile-mt" id="hochelaForm">
    <!-- Step 0 -->
    <div class="container wizard-container">
        <div class="wizard-card" id="step-0">
            <h2 class="step-heading">Welcome to Hochela!</h2>
            <div class="content-row">
                <div class="content-left">
                    <p>Welcome to Hochela, where finding your ideal apartment or cozy hostel is just a click away!</p>
                </div>
                <div class="content-right">
                    <ol class="ol-images">
                        <li>
                            <h5>1. Choose your ideal space</h5>
                            <p>Whether it's a private apartment, shared house, or something in between, to find the
                                perfect match for your lifestyle.</p>
                            <img src="{{ getImage(imagePath()['icons']['path'].'/bed.png') }}"/>
                        </li>
                        <li>
                            <h5>2. What’s your sweet spot for rent?</h5>
                            <p>Let us know your budget so we can match you with the perfect place!</p>
                            <img src="{{ getImage(imagePath()['icons']['path'].'/keys.png') }}" alt="budget icon"/>
                        </li>
                        <li>
                            <h5>3. How close do you want to be to campus?</h5>
                            <p>A quick walk, a short bike ride, or maybe further out?</p>
                            <img src="{{ getImage(imagePath()['icons']['path'].'/building.png') }}"/>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="next-button">
                <img src="{{ getImage(imagePath()['icons']['path'].'/Forward-btn.png')}}" alt="next button"
                     onclick="showStep(1)"/>
            </div>
        </div>
    </div>

    <!-- Step 1 -->
    <div class="container wizard-container" style="display: none" id="step-1">
        <div class="wizard-card">
            <h2 class="step-heading">Choose Your Ideal Space</h2>
            <div class="content-row">
                <div class="content-left">
                    <p>Choose your ideal space, whether it's a private apartment, shared house, or something in
                        between.</p>
                </div>
                <div class="content-right text-center">
                    <img src="{{ getImage(imagePath()['icons']['path'].'/bed-world.png') }}" alt="Step 1 Image"
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
                    <img src={{ getImage(imagePath()['icons']['path'].'/hostel.svg') }} alt="Hostel Icon"/>
                    <p>Hostel</p>
                    <input type="radio" name="place_type" value="Hostel"/>
                </div>
                <div class="option" id="option2" onclick="selectOption(2)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/apartment.svg') }} alt="Apartment Icon"/>
                    <p>Apartment</p>
                    <input type="radio" name="place_type" value="Apartment"/>
                </div>
                <div class="option" id="option3" onclick="selectOption(3)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/self-contained.svg') }} alt="Self-Contained Icon"/>
                    <p>Self-Contained</p>
                    <input type="radio" name="place_type" value="Self-Contained"/>
                </div>
                <div class="option" id="option4" onclick="selectOption(4)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/single.svg') }} alt="Single Room Icon"/>
                    <p>Single Room</p>
                    <input type="radio" name="place_type" value="Single Room"/>
                </div>
                <div class="option" id="option5" onclick="selectOption(5)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/two-beds.svg') }} alt="Two Bedroom Apartment
                         Icon"/>
                    <p>2 Bedroom Apartment</p>
                    <input type="radio" name="place_type" value="2 Bedroom Apartment"/>
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
            <h2 class="step-heading">What amenities are must-haves for you?</h2>
            <div class="options-container">
                <div class="option" id="option6" onclick="selectOption(6)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/internet.svg') }} alt="Good Internet Service
                         Icon"/>
                    <p>Good Internet Service</p>
                    <input type="checkbox" name="amenities" value="Good Internet Service"/>
                </div>
                <div class="option" id="option7" onclick="selectOption(7)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/tv.svg') }} alt="TV Icon"/>
                    <p>TV</p>
                    <input type="checkbox" name="amenities" value="TV"/>
                </div>
                <div class="option" id="option8" onclick="selectOption(8)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/kitchen.svg') }} alt="Kitchen Icon"/>
                    <p>Kitchen</p>
                    <input type="checkbox" name="amenities" value="Kitchen"/>
                </div>
                <div class="option" id="option9" onclick="selectOption(9)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/bathroom.svg') }} alt="Bathroom Icon"/>
                    <p>Functional Bathroom</p>
                    <input type="checkbox" name="amenities" value="Functional Bathroom"/>
                </div>
                <div class="option" id="option10" onclick="selectOption(10)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/parking.svg') }} alt="Parking Icon"/>
                    <p>Parking</p>
                    <input type="checkbox" name="amenities" value="Parking"/>
                </div>
                <div class="option" id="option11" onclick="selectOption(11)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/study.svg') }} alt="Study Space Icon"/>
                    <p>Study Space</p>
                    <input type="checkbox" name="amenities" value="Study Space"/>
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
            <h2 class="step-heading">What’s Your Sweet Spot for Rent?</h2>
            <div class="content-row">
                <div class="content-left">
                    <p>Share your budget to help us find the best rental options within your price range.</p>
                </div>
                <div class="content-right text-center">
                    <img src={{ getImage(imagePath()['icons']['path'].'/keys-world.png') }} alt="Step 4 Image"
                    class="img-fluid"/>
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
            <h2 class="step-heading">What is Your Sweet Spot for Rent?</h2>
            <div class="slider-container">
                <input type="range" class="slider" id="rentRange" min="10000" max="200000" step="1000" value="80000"
                       oninput="updateValue(this.value)"/>
                <div class="amount-display">
                    <span>Min</span>
                    <span><strong><span id="rentValue">80,000</span></strong></span>
                    <span>Max</span>
                </div>
                <input type="hidden" name="rent" id="rentInput" value="80000"/>
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
            <h2 class="step-heading">How Close Do You Want to Be to Campus?</h2>
            <div class="content-row">
                <div class="content-left">
                    <p>Select your transportation preference based on the distance to campus.</p>
                </div>
                <div class="content-right text-center">
                    <img src={{ getImage(imagePath()['icons']['path'].'/house.svg') }} alt="Step 6 Image"
                    class="img-fluid"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 5)">Back</button>
                <button class="btn btn-primary" onclick="navigateToStep(event, 7)">Next</button>
            </div>
        </div>
    </div>

    <!-- Step 7 -->
    <div class="container wizard-container" style="display: none" id="step-7">
        <div class="wizard-card">
            <h2 class="step-heading">How Close Do You Want to Be to Campus?</h2>
            <div class="options-container">
                <div class="option" id="option12" onclick="selectOption(12)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/walk.svg') }} alt="Walk Icon"/>
                    <p>Walk</p>
                    <p>(5-10 Minutes)</p>
                    <input type="radio" name="transportation" value="Walk"/>
                </div>
                <div class="option" id="option13" onclick="selectOption(13)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/bicycle.svg') }} alt="Motorbike Ride Icon"/>
                    <p>Motorbike Ride</p>
                    <p>(10-20 minutes)</p>
                    <input type="radio" name="transportation" value="Motorbike Ride"/>
                </div>
                <div class="option" id="option14" onclick="selectOption(14)">
                    <img src={{ getImage(imagePath()['icons']['path'].'/bus.svg') }} alt="Bus Ride Icon"/>
                    <p>Bus Ride</p>
                    <p>(30+ minutes)</p>
                    <input type="radio" name="transportation" value="Bus Ride"/>
                </div>
            </div>
            <div class="navigation-buttons">
                <button class="btn btn-secondary" onclick="navigateToStep(event, 6)">Back</button>
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
        const steps = document.querySelectorAll(".wizard-container");
        steps.forEach((el, index) => {
            el.style.display = index === step ? "flex" : "none"; // Show the selected step
        });
    }

    function updateValue(val) {
        document.getElementById("rentValue").innerText = val;
        document.getElementById("rentInput").value = val; // Update the hidden input with the selected value
    }

    function submitForm() {
        event.preventDefault();
        const formData = new FormData(document.getElementById("hochelaForm"));

        console.log('got here '.FormData)
        // AJAX request to the Laravel controller
        fetch('/on-boarding', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Laravel CSRF token
            },
        })
            .then(response => response.json())
            .then(data => {
                // Handle success response
                console.log(data);
                console.log('Form submitted successfully!');
                window.location.href = '{{ route('home') }}';
            })
            .catch((error) => {
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
        showStep(step); // Show the requested step
    }
</script>
</body>
</html>
