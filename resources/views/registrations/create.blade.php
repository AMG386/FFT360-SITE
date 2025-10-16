{{-- resources/views/registrations/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>FFT360 </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root{
      --fft-yellow:#FFD000;
      --fft-black:#000000;
      --fft-black-2:#0a0a0a;
      --fft-white:#ffffff;
    }
    .fft-focus:focus{
      outline:none;
      box-shadow: 0 0 0 3px rgba(255,208,0,0.45);
      border-color: var(--fft-yellow);
    }
    .fft-label::after{
      content: attr(data-required);
      margin-left: .25rem;
      color: #ff5a5a;
    }
  </style>
</head>
<body class="bg-[color:var(--fft-black)] text-[color:var(--fft-white)] min-h-screen">

  {{-- HEADER --}}
  <header class="border-b border-yellow-500/40">
    <div class="max-w-3xl mx-auto px-6 py-6 flex items-center gap-4">
      {{-- Replace with your logo file placed at /public/images/fft360-logo.png --}}
    <img src="{{ asset('img/logo.png') }}" alt="FFT360 Logo" class="h-14 w-auto rounded-md bg-black/0">
      <div>
        <h1 class="text-2xl font-extrabold tracking-wide" style="color:var(--fft-yellow);">FFT360 HEALTH CLUB</h1>
        <p class="text-sm opacity-80"></p>
      </div>
    </div>
  </header>

  <main class="max-w-3xl mx-auto p-6">
    {{-- FLASH / VALIDATION --}}
    @if ($errors->any())
      <div class="mb-4 rounded-lg border border-red-400/40 bg-red-900/20 p-4 text-sm">
        <div class="font-semibold text-red-300 mb-2">Please fix the following:</div>
        <ul class="list-disc list-inside text-red-200">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="rounded-2xl p-6 border border-yellow-500/30 bg-[color:var(--fft-black-2)] shadow-[0_0_0_1px_rgba(255,208,0,.05)]">
      <p class="text-sm opacity-80 mb-6">Fields marked with <span class="text-red-400">*</span> are required.</p>

      <form id="clientForm" class="space-y-8" action="{{ route('registrations.store') }}" method="POST" novalidate>
        @csrf

        {{-- CONTACT --}}
        <section>
          <h2 class="text-lg font-semibold mb-3" style="color:var(--fft-yellow);">Contact Details</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="fft-label block text-sm mb-1" data-required="*">First Name</label>
              <input required id="first_name" name="first_name" type="text"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('first_name') }}" placeholder="John">
            </div>
            <div>
              <label class="fft-label block text-sm mb-1" data-required="*">Last Name</label>
              <input required id="last_name" name="last_name" type="text"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('last_name') }}" placeholder="Doe">
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm mb-1">Address</label>
              <textarea id="address" name="address" rows="2"
                        class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                        placeholder="Street, City, State, PIN">{{ old('address') }}</textarea>
            </div>
            <div>
              <label class="fft-label block text-sm mb-1" data-required="*">Mobile Number</label>
              <input required id="mobile_number" name="mobile_number" type="tel"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('mobile_number') }}" placeholder="+91 98xxxxxxx0" pattern="^[0-9+\-()\s]{7,}$">
            </div>
            <div>
              <label class="fft-label block text-sm mb-1" data-required="*">Email</label>
              <input required id="email" name="email" type="email"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('email') }}" placeholder="you@example.com">
            </div>
            <div>
              <label class="fft-label block text-sm mb-1" data-required="*">Gender</label>
              <select required id="gender" name="gender"
                      class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus">
                <option value="">Select</option>
                @foreach (['Male','Female','Other','Prefer not to say'] as $g)
                  <option value="{{ $g }}" @selected(old('gender')===$g)>{{ $g }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="fft-label block text-sm mb-1" data-required="*">Date of Birth</label>
              <input required id="dob" name="dob" type="date"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('dob') }}">
            </div>
            <div>
              <label class="block text-sm mb-1">Height (cm)</label>
              <input id="height" name="height" type="number" step="0.1"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('height') }}" placeholder="e.g., 172">
            </div>
            <div>
              <label class="block text-sm mb-1">Weight (kg)</label>
              <input id="weight" name="weight" type="number" step="0.1"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('weight') }}" placeholder="e.g., 72">
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm mb-1">Referred By</label>
              <input id="referred_by" name="referred_by" type="text"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('referred_by') }}" placeholder="Friend / Campaign / Trainer Name">
            </div>
          </div>
        </section>

        {{-- HEALTH --}}
        <section>
          <h2 class="text-lg font-semibold mb-3" style="color:var(--fft-yellow);">Health</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm mb-1">Do you have Health Insurance?</label>
              <select id="has_insurance" name="has_insurance"
                      class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus">
                <option value="">Select</option>
                @foreach (['Yes','No'] as $v)
                  <option value="{{ $v }}" @selected(old('has_insurance')===$v)>{{ $v }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-sm mb-1">Any Health Issue?</label>
              <select id="has_health_issue" name="has_health_issue"
                      class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus">
                <option value="">Select</option>
                @foreach (['Yes','No'] as $v)
                  <option value="{{ $v }}" @selected(old('has_health_issue')===$v)>{{ $v }}</option>
                @endforeach
              </select>
            </div>
            <div class="md:col-span-2 @if(old('has_health_issue')!=='Yes') hidden @endif" id="health_issue_details_wrap">
              <label class="block text-sm mb-1" for="health_issue_details">Health Issue Details (if any)</label>
              <textarea id="health_issue_details" name="health_issue_details" rows="3"
                        class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                        placeholder="E.g., Diabetes, Hypertension, Back pain…">{{ old('health_issue_details') }}</textarea>
            </div>
          </div>
        </section>

        {{-- PROFESSION --}}
        <section>
          <h2 class="text-lg font-semibold mb-3" style="color:var(--fft-yellow);">Profession</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm mb-1" for="profession_type">Profession Type</label>
              <select id="profession_type" name="profession_type"
                      class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus">
                <option value="">Select</option>
                @foreach (['Student','Private Job','Government Job','Business','Freelancer','Homemaker','Retired','Other'] as $p)
                  <option value="{{ $p }}" @selected(old('profession_type')===$p)>{{ $p }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-sm mb-1" for="profession_description">Profession Description</label>
              <input id="profession_description" name="profession_description" type="text"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('profession_description') }}" placeholder="Role / Company / Shift pattern">
            </div>
          </div>
        </section>

        {{-- BUSINESS --}}
        <section>
          <h2 class="text-lg font-semibold mb-3" style="color:var(--fft-yellow);">Business (optional)</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm mb-1" for="business_name">Business Name</label>
              <input id="business_name" name="business_name" type="text"
                     class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                     value="{{ old('business_name') }}" placeholder="If applicable">
            </div>
            <div class="md:col-span-2">
              <label class="block text-sm mb-1" for="business_details">Business Details</label>
              <textarea id="business_details" name="business_details" rows="3"
                        class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus"
                        placeholder="What do you do?">{{ old('business_details') }}</textarea>
            </div>
          </div>
        </section>

        {{-- REGISTRATION TYPE + TERMS --}}
        <section>
          <h2 class="text-lg font-semibold mb-3" style="color:var(--fft-yellow);">Registration Type</h2>
          <div>
            <label class="fft-label block text-sm mb-1" data-required="*">Select Registration Type</label>
            <select required id="registration_type" name="registration_type"
                    class="w-full border rounded-lg p-2.5 bg-black/40 border-yellow-500/30 text-white fft-focus">
              <option value="">Select</option>
              @foreach (['Gym Membership','Online Training App Subscription'] as $rt)
                <option value="{{ $rt }}" @selected(old('registration_type')===$rt)>{{ $rt }}</option>
              @endforeach
            </select>
          </div>

          <div class="pt-3">
            <label class="flex items-start gap-2 text-sm">
              <input type="checkbox" required id="terms" name="terms"
                     class="mt-1 accent-yellow-400 border-yellow-600 focus:ring-yellow-400" {{ old('terms') ? 'checked' : '' }}>
              <span>
                I hereby confirm that I have read and accept the
                <a href="#terms-modal" id="open-terms" class="text-yellow-400 underline hover:text-yellow-300">Terms & Conditions</a>.
              </span>
            </label>
          </div>
        </section>

        {{-- SUBMIT --}}
        <div class="flex items-center gap-3 pt-2">
          <button type="submit"
                  class="px-5 py-2.5 rounded-xl bg-[color:var(--fft-yellow)] text-black font-extrabold tracking-wide hover:opacity-90 active:scale-[.99]">
            SUBMIT
          </button>
          <a href="{{ route('registrations.create') }}"
             class="px-4 py-2 rounded-lg border border-yellow-500/30 text-yellow-300 hover:bg-yellow-500/10">Reset</a>
        </div>
      </form>
    </div>

    <p class="text-xs opacity-60 mt-3 text-center">Your information is used for membership processing and safety only.</p>
  </main>

  {{-- TERMS & CONDITIONS MODAL --}}
  <div id="terms-modal" class="fixed inset-0 hidden z-50">
    <div class="absolute inset-0 bg-black/70"></div>
    <div class="relative max-w-3xl mx-auto my-10 bg-[color:var(--fft-black-2)] border border-yellow-500/40 rounded-2xl shadow-xl">
      <div class="flex items-center justify-between px-6 py-4 border-b border-yellow-500/30">
        <h3 class="text-lg font-bold" style="color:var(--fft-yellow);">FFT360 Health Club — Terms & Conditions</h3>
        <button id="close-terms" class="text-yellow-300 hover:text-yellow-100 text-xl" aria-label="Close">×</button>
      </div>
      <div class="p-6 max-h-[70vh] overflow-y-auto text-sm leading-6">
        <h4 class="font-semibold mb-2">1. General Agreement</h4>
        <p class="opacity-90 mb-4">By signing up for FFT360 Health Club or submitting the registration form, you agree to abide by all gym rules, regulations, and policies stated here and displayed within the facility. FFT360 reserves the right to modify these terms without prior notice.</p>

        <h4 class="font-semibold mb-2">2. Membership</h4>
        <ul class="list-disc list-inside opacity-90 mb-4">
          <li>Memberships are personal and non-transferable.</li>
          <li>The membership fee is non-refundable, except under special circumstances determined by management.</li>
          <li>Access to the facility is limited to current, active members with valid ID or digital check-in.</li>
          <li>Members must be at least 16 years old. Anyone under 18 must have parental consent.</li>
        </ul>

        <h4 class="font-semibold mb-2">3. Health & Safety</h4>
        <ul class="list-disc list-inside opacity-90 mb-4">
          <li>Members must disclose any pre-existing medical conditions before starting a fitness program.</li>
          <li>FFT360 Health Club and its trainers are not medical professionals; participation in any workout is at your own risk.</li>
          <li>Members are advised to consult a doctor before beginning any fitness program.</li>
          <li>The gym is not responsible for injuries, accidents, or health issues resulting from use of equipment or participation in activities.</li>
          <li>Use of alcohol, drugs, or tobacco is strictly prohibited within the premises.</li>
        </ul>

        <h4 class="font-semibold mb-2">4. Use of Facilities & Equipment</h4>
        <ul class="list-disc list-inside opacity-90 mb-4">
          <li>Proper gym attire and clean sports shoes must be worn at all times.</li>
          <li>Members must wipe down equipment after use and return weights to their racks.</li>
          <li>Any damage to equipment caused by negligence may result in charges or suspension.</li>
          <li>Time limits may be enforced on cardio machines during peak hours.</li>
        </ul>

        <h4 class="font-semibold mb-2">5. Personal Training</h4>
        <ul class="list-disc list-inside opacity-90 mb-4">
          <li>Personal training sessions are to be conducted only by FFT360-certified trainers.</li>
          <li>Outside or freelance trainers are not allowed.</li>
          <li>Training sessions must be booked and paid for in advance.</li>
        </ul>

        <h4 class="font-semibold mb-2">6. Locker & Personal Belongings</h4>
        <ul class="list-disc list-inside opacity-90 mb-4">
          <li>Lockers are provided for daily use only.</li>
          <li>The club is not responsible for lost, stolen, or damaged items.</li>
          <li>Members are advised not to leave valuables in the gym.</li>
        </ul>

        <h4 class="font-semibold mb-2">7. Payments & Renewals</h4>
        <ul class="list-disc list-inside opacity-90 mb-4">
          <li>Membership and training fees must be paid in full before usage of facilities.</li>
          <li>Late renewals may incur additional charges or access restrictions.</li>
          <li>FFT360 may adjust fees, plans, or offers without prior notice.</li>
        </ul>

        <h4 class="font-semibold mb-2">8. Conduct & Behaviour</h4>
        <ul class="list-disc list-inside opacity-90 mb-4">
          <li>Members must show respect towards staff and other members.</li>
          <li>Abusive language, harassment, or disruptive behaviour will result in immediate cancellation of membership.</li>
          <li>The management reserves the right to refuse entry or terminate memberships for misconduct.</li>
        </ul>

        <h4 class="font-semibold mb-2">9. Privacy Policy</h4>
        <p class="opacity-90 mb-4">FFT360 may collect and store basic personal and health information for membership and safety purposes. This information will not be shared with third parties without consent, except as required by law.</p>

        <h4 class="font-semibold mb-2">10. Liability Waiver</h4>
        <p class="opacity-90 mb-4">By using FFT360 Health Club’s facilities, you acknowledge and accept that participation in physical activities involves certain inherent risks. You agree to waive all claims against FFT360 Health Club, its staff, trainers, and affiliates for any injuries or losses incurred while using the premises.</p>

        <h4 class="font-semibold mb-2">11. Termination of Membership</h4>
        <p class="opacity-90 mb-4">FFT360 Health Club reserves the right to terminate any membership at any time for violation of these terms, misuse of facilities, or failure to make payments.</p>

        <h4 class="font-semibold mb-2">12. Contact</h4>
        <p class="opacity-90 mb-4">
          For any clarification or disputes, please contact:<br>
          <strong>Email:</strong> teamfft360@gmail.com<br>
          <strong>Phone:</strong> +919778605470,+919946689141,+919778605472
        </p>

        <div class="flex justify-end pt-2">
          <button id="close-terms-2" class="px-4 py-2 rounded-lg bg-[color:var(--fft-yellow)] text-black font-bold hover:opacity-90">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- SCRIPTS --}}
  <script>
    // Health issue toggle
    const hasIssue = document.getElementById('has_health_issue');
    const issueWrap = document.getElementById('health_issue_details_wrap');
    if (hasIssue) {
      hasIssue.addEventListener('change', () => {
        if (hasIssue.value === 'Yes') issueWrap.classList.remove('hidden');
        else issueWrap.classList.add('hidden');
      });
    }

    // Terms modal open/close
    (function(){
      const open = document.getElementById('open-terms');
      const modal = document.getElementById('terms-modal');
      const close1 = document.getElementById('close-terms');
      const close2 = document.getElementById('close-terms-2');

      function show(){ modal.classList.remove('hidden'); document.body.style.overflow='hidden'; }
      function hide(){ modal.classList.add('hidden'); document.body.style.overflow=''; }

      if (open){ open.addEventListener('click', function(e){ e.preventDefault(); show(); }); }
      if (close1){ close1.addEventListener('click', function(e){ e.preventDefault(); hide(); }); }
      if (close2){ close2.addEventListener('click', function(e){ e.preventDefault(); hide(); }); }
      modal && modal.addEventListener('click', function(e){ if (e.target === modal) hide(); });
      document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape') hide(); });
    })();
  </script>
</body>
</html>
