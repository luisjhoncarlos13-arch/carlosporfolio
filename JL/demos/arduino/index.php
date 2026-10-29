<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arduino HydroSense | Touchless Ultrasonic Water Dispenser Simulation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Orbitron:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-green: #00ff88;
            --neon-cyan: #00e5ff;
            --neon-red: #ff3366;
            --neon-yellow: #ffcc00;
            --bg-dark: #070a12;
            --bg-panel: #0d1322;
            --bg-card: #121a30;
            --border-tech: rgba(0, 255, 136, 0.25);
            --border-dim: rgba(255, 255, 255, 0.08);
            --text-main: #e2e8f0;
            --text-dim: #64748b;
            --font-tech: 'Orbitron', monospace;
            --font-code: 'JetBrains Mono', monospace;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: var(--font-code);
            line-height: 1.5;
            background-image: 
                linear-gradient(rgba(0, 255, 136, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 136, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
            padding-bottom: 80px;
        }

        /* Demo Header Bar */
        .demo-bar {
            background: #04060c;
            border-bottom: 1px solid var(--border-tech);
            padding: 10px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .demo-back-btn {
            color: var(--neon-cyan);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: color 0.2s;
        }
        .demo-back-btn:hover { color: #fff; }
        .demo-badge {
            background: rgba(0, 255, 136, 0.12);
            color: var(--neon-green);
            border: 1px solid var(--border-tech);
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* Main Container */
        .container {
            max-width: 1240px;
            margin: 24px auto 0;
            padding: 0 20px;
        }

        /* Console Title Bar */
        .console-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-dim);
            flex-wrap: wrap;
            gap: 16px;
        }
        .console-title-group h1 {
            font-family: var(--font-tech);
            font-size: 1.8rem;
            letter-spacing: 1.5px;
            color: #fff;
        }
        .console-title-group h1 span {
            color: var(--neon-green);
            text-shadow: 0 0 15px rgba(0, 255, 136, 0.6);
        }
        .console-status-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(0, 255, 136, 0.08);
            border: 1px solid var(--border-tech);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.8rem;
        }
        .pulse-led {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--neon-green);
            box-shadow: 0 0 10px var(--neon-green);
            animation: ledBlink 1.4s infinite ease-in-out;
        }
        @keyframes ledBlink {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(0.8); }
        }

        /* Layout Grid */
        .hardware-grid {
            display: grid;
            grid-template-columns: 1.25fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        /* Hardware Simulator Chamber Card */
        .chamber-card {
            background: var(--bg-panel);
            border: 1px solid var(--border-tech);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6), inset 0 0 30px rgba(0, 255, 136, 0.03);
            display: flex;
            flex-direction: column;
        }
        .chamber-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .chamber-title-row h3 {
            font-family: var(--font-tech);
            font-size: 1.05rem;
            letter-spacing: 1px;
            color: var(--neon-green);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Visual Dispenser Stage */
        .stage-box {
            background: #040810;
            border: 1px solid var(--border-dim);
            border-radius: 12px;
            height: 340px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Dispenser Nozzle & Sensor Head */
        .sensor-head {
            background: #1b263b;
            border: 2px solid #334155;
            border-radius: 8px;
            padding: 10px 24px;
            display: flex;
            gap: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.8);
            position: relative;
            z-index: 5;
        }
        .ultrasonic-eye {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: radial-gradient(circle, #0ea5e9 30%, #0369a1 80%);
            border: 2px solid #38bdf8;
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.5);
            position: relative;
        }
        .nozzle-spout {
            position: absolute;
            bottom: -14px;
            left: 50%;
            transform: translateX(-50%);
            width: 16px;
            height: 14px;
            background: #475569;
            border-radius: 0 0 4px 4px;
            border: 1px solid #64748b;
        }

        /* Sound Waves Animation */
        .ping-waves {
            position: absolute;
            top: 60px;
            width: 140px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            pointer-events: none;
            opacity: 0.4;
            transition: opacity 0.3s;
        }
        .ping-waves.active {
            opacity: 1;
        }
        .wave-line {
            height: 2px;
            background: var(--neon-cyan);
            border-radius: 999px;
            box-shadow: 0 0 8px var(--neon-cyan);
            animation: waveExpand 1.2s infinite ease-out;
        }
        .wave-line:nth-child(1) { width: 40px; animation-delay: 0s; }
        .wave-line:nth-child(2) { width: 80px; animation-delay: 0.3s; }
        .wave-line:nth-child(3) { width: 120px; animation-delay: 0.6s; }

        @keyframes waveExpand {
            0% { opacity: 0; transform: scaleY(0.5); }
            50% { opacity: 1; }
            100% { opacity: 0; transform: scaleY(1.5); }
        }

        /* Flow Stream Animation */
        .water-stream {
            position: absolute;
            top: 72px;
            width: 8px;
            height: 150px;
            background: linear-gradient(180deg, #38bdf8 0%, #0284c7 100%);
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.9);
            border-radius: 999px;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
            z-index: 4;
        }
        .water-stream.flowing {
            opacity: 1;
            animation: streamPulse 0.15s infinite alternate;
        }
        @keyframes streamPulse {
            0% { transform: scaleX(0.9); }
            100% { transform: scaleX(1.1); }
        }

        /* Cup Apparatus */
        .cup-stage {
            position: absolute;
            bottom: 25px;
            width: 110px;
            height: 150px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: none;
            border-radius: 0 0 14px 14px;
            background: rgba(255, 255, 255, 0.03);
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cup-water-level {
            width: 100%;
            height: 0%;
            background: linear-gradient(180deg, #38bdf8, #0369a1);
            box-shadow: inset 0 2px 8px rgba(255,255,255,0.6), 0 0 20px rgba(56, 189, 248, 0.4);
            transition: height 0.1s linear;
            position: relative;
        }
        .cup-percent-badge {
            position: absolute;
            bottom: 50%;
            left: 50%;
            transform: translate(-50%, 50%);
            font-size: 0.9rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 0 6px rgba(0,0,0,0.8);
            pointer-events: none;
        }

        /* Cup State Outside Threshold */
        .cup-stage.away {
            transform: translateX(130px) scale(0.9);
            opacity: 0.35;
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Slider Controls */
        .control-panel-strip {
            margin-top: 20px;
            background: var(--bg-card);
            border: 1px solid var(--border-dim);
            padding: 18px;
            border-radius: 12px;
        }
        .slider-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .slider-label {
            font-size: 0.85rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .slider-val {
            font-family: var(--font-tech);
            font-size: 1.2rem;
            color: var(--neon-cyan);
            font-weight: 700;
        }
        .distance-slider {
            width: 100%;
            height: 8px;
            border-radius: 4px;
            background: #1e293b;
            outline: none;
            -webkit-appearance: none;
            cursor: pointer;
        }
        .distance-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--neon-green);
            box-shadow: 0 0 12px var(--neon-green);
            cursor: pointer;
        }
        .quick-actions {
            display: flex;
            gap: 10px;
            margin-top: 14px;
            flex-wrap: wrap;
        }
        .tech-btn {
            background: rgba(0, 255, 136, 0.08);
            border: 1px solid var(--border-tech);
            color: var(--neon-green);
            padding: 9px 16px;
            border-radius: 8px;
            font-family: var(--font-code);
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
            white-space: nowrap;
            text-align: center;
        }
        .tech-btn:hover {
            background: var(--neon-green);
            color: #040810;
            box-shadow: 0 0 15px rgba(0, 255, 136, 0.4);
        }

        /* Telemetry & Serial Monitor Column */
        .telemetry-col {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Relays & Hardware Status Card */
        .status-card {
            background: var(--bg-panel);
            border: 1px solid var(--border-tech);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.6);
        }
        .telemetry-metric-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-top: 16px;
        }
        .metric-box {
            background: var(--bg-card);
            border: 1px solid var(--border-dim);
            border-radius: 10px;
            padding: 14px;
        }
        .metric-label {
            font-size: 0.72rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 4px;
        }
        .metric-value {
            font-family: var(--font-tech);
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .state-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #475569;
        }
        .state-indicator.active {
            background: var(--neon-green);
            box-shadow: 0 0 10px var(--neon-green);
        }

        /* Serial Monitor Console */
        .serial-card {
            background: #03060d;
            border: 1px solid rgba(0, 229, 255, 0.3);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 250px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }
        .serial-topbar {
            background: #08101e;
            padding: 10px 18px;
            border-bottom: 1px solid rgba(0, 229, 255, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.78rem;
            color: var(--neon-cyan);
            letter-spacing: 1px;
        }
        .serial-output {
            padding: 14px 18px;
            font-size: 0.75rem;
            color: #38bdf8;
            overflow-y: auto;
            max-height: 220px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-family: var(--font-code);
        }
        .log-entry {
            display: flex;
            gap: 12px;
            line-height: 1.4;
        }
        .log-time { color: var(--text-dim); }
        .log-active { color: var(--neon-green); font-weight: 600; }
        .log-idle { color: #64748b; }

        /* Code Preview Accordion */
        .code-accordion {
            background: var(--bg-panel);
            border: 1px solid var(--border-dim);
            border-radius: 14px;
            margin-top: 24px;
            overflow: hidden;
        }
        .code-accordion-header {
            padding: 16px 20px;
            background: var(--bg-card);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            font-family: var(--font-tech);
            color: var(--neon-cyan);
        }
        .code-content {
            padding: 20px;
            background: #040810;
            overflow-x: auto;
            font-size: 0.8rem;
            color: #cbd5e1;
            display: none;
            border-top: 1px solid var(--border-dim);
        }
        .code-content.open { display: block; }

        @media (max-width: 960px) {
            .hardware-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Demo Bar Link Back to Portfolio -->
    <div class="demo-bar">
        <a href="../../index.php#projects" class="demo-back-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
            Back to John Luis Carlos Portfolio
        </a>
        <span class="demo-badge">LIVE DEMO • IOT &amp; EMBEDDED SYSTEMS</span>
    </div>

    <div class="container">

        <!-- Console Header -->
        <header class="console-header">
            <div class="console-title-group">
                <h1>ARDUINO <span>HYDROSENSE</span></h1>
                <p style="color:var(--text-dim); font-size:0.85rem;">Contactless Smart Water Dispenser Microcontroller Telemetry Console</p>
            </div>
            <div class="console-status-pill">
                <span class="pulse-led"></span>
                <span>MCU: ATMEGA328P @ 16.0 MHz (ONLINE)</span>
            </div>
        </header>

        <!-- Hardware Stage & Telemetry Grid -->
        <div class="hardware-grid">

            <!-- Hardware Simulator Chamber -->
            <div class="chamber-card">
                <div class="chamber-title-row">
                    <h3>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
                        DISPENSER CHAMBER (DIGITAL TWIN)
                    </h3>
                    <span id="dispenseStateBadge" style="font-size:0.75rem; color:var(--text-dim); background:#1e293b; padding:3px 10px; border-radius:4px;">STANDBY</span>
                </div>

                <!-- Stage -->
                <div class="stage-box">
                    <!-- Sensor Head Nozzle -->
                    <div class="sensor-head">
                        <div class="ultrasonic-eye" title="Transmitter (TRIG)"></div>
                        <div class="ultrasonic-eye" title="Receiver (ECHO)"></div>
                        <div class="nozzle-spout"></div>
                    </div>

                    <!-- Waves Animation -->
                    <div class="ping-waves active" id="pingWaves">
                        <div class="wave-line"></div>
                        <div class="wave-line"></div>
                        <div class="wave-line"></div>
                    </div>

                    <!-- Water Stream -->
                    <div class="water-stream" id="waterStream"></div>

                    <!-- Glass / Cup -->
                    <div class="cup-stage" id="cupStage">
                        <div class="cup-water-level" id="cupWaterLevel"></div>
                        <span class="cup-percent-badge" id="cupPercentBadge">0%</span>
                    </div>
                </div>

                <!-- Slider Controls -->
                <div class="control-panel-strip">
                    <div class="slider-row">
                        <span class="slider-label">Ultrasonic Distance Sensor:</span>
                        <span class="slider-val"><span id="distVal">6.5</span> cm</span>
                    </div>
                    <input type="range" class="distance-slider" id="distanceSlider" min="2" max="30" step="0.5" value="6.5" oninput="onDistanceChange(this.value)">
                    <div style="display:flex; justify-content:space-between; font-size:0.72rem; color:var(--text-dim); margin-top:6px;">
                        <span>2.0 cm (Close)</span>
                        <span style="color:var(--neon-green); font-weight:700;">TRIGGER THRESHOLD: &lt; 10.0 cm</span>
                        <span>30.0 cm (Far)</span>
                    </div>

                    <div class="quick-actions">
                        <button class="tech-btn" onclick="setSlider(6.5)">Place Cup (6.5 cm)</button>
                        <button class="tech-btn" onclick="setSlider(22.0)">Remove Cup (22.0 cm)</button>
                        <button class="tech-btn" onclick="emptyCup()" style="border-color:rgba(255,51,102,0.4); color:var(--neon-red);">Empty Cup ↺</button>
                    </div>
                </div>
            </div>

            <!-- Hardware Telemetry & Serial Monitor Column -->
            <div class="telemetry-col">

                <!-- Hardware States Card -->
                <div class="status-card">
                    <h3 style="font-family:var(--font-tech); font-size:0.95rem; color:#fff; letter-spacing:0.8px;">
                        HARDWARE CIRCUIT TELEMETRY
                    </h3>

                    <div class="telemetry-metric-grid">
                        <div class="metric-box">
                            <div class="metric-label">5V Single-Channel Relay</div>
                            <div class="metric-value">
                                <span class="state-indicator" id="relayDot"></span>
                                <span id="relayText">STANDBY</span>
                            </div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">12V DC Solenoid Valve</div>
                            <div class="metric-value">
                                <span class="state-indicator" id="solenoidDot"></span>
                                <span id="solenoidText">CLOSED</span>
                            </div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Water Flow Rate</div>
                            <div class="metric-value" id="flowRateVal" style="color:var(--neon-cyan);">0.00 L/m</div>
                        </div>
                        <div class="metric-box">
                            <div class="metric-label">Volume Dispensed</div>
                            <div class="metric-value" id="volumeVal" style="color:var(--neon-green);">0 mL</div>
                        </div>
                    </div>
                </div>

                <!-- Serial Monitor -->
                <div class="serial-card">
                    <div class="serial-topbar">
                        <span>ARDUINO SERIAL MONITOR &bull; COM4 @ 9600 BAUD</span>
                        <button onclick="clearSerial()" style="background:none; border:none; color:var(--text-dim); cursor:pointer; font-size:0.75rem;">Clear Log</button>
                    </div>
                    <div class="serial-output" id="serialOutput">
                        <div class="log-entry"><span class="log-time">[00:00:01]</span> <span>[SYSTEM] Arduino Uno booting up...</span></div>
                        <div class="log-entry"><span class="log-time">[00:00:01]</span> <span>[SYSTEM] HC-SR04 ultrasonic initialized on Pins 9, 10.</span></div>
                        <div class="log-entry"><span class="log-time">[00:00:02]</span> <span>[SYSTEM] 5V Relay initialized on Pin 7 (LOW).</span></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Arduino Source Code Dropdown -->
        <div class="code-accordion">
            <div class="code-accordion-header" onclick="toggleCode()">
                <span>&lt;/&gt; VIEW EMBEDDED ARDUINO C++ SKETCH (HydroSense.ino)</span>
                <span id="codeToggleArrow">▼</span>
            </div>
            <pre class="code-content" id="codeContent"><code>// ====================================================================
// Arduino Touchless Water Dispenser System
// Developer: John Luis Carlos (BSIT 4th Year)
// Components: Arduino Uno, HC-SR04 Ultrasonic, 5V Relay, 12V Solenoid
// ====================================================================

const int TRIG_PIN  = 9;
const int ECHO_PIN  = 10;
const int RELAY_PIN = 7;

const float DISTANCE_THRESHOLD = 10.0; // cm
const unsigned long TIMEOUT_MAX = 15000; // 15s safety auto-cutoff

void setup() {
  Serial.begin(9600);
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);
  pinMode(RELAY_PIN, OUTPUT);
  digitalWrite(RELAY_PIN, LOW); // Relay Active-Low or High
  Serial.println("[BOOT] HydroSense Dispenser Active");
}

void loop() {
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);

  long duration = pulseIn(ECHO_PIN, HIGH);
  float distance = (duration * 0.0343) / 2.0;

  if (distance > 0 && distance <= DISTANCE_THRESHOLD) {
    digitalWrite(RELAY_PIN, HIGH); // Energize Solenoid
    Serial.print("[DISPENSING] Cup detected at: ");
    Serial.print(distance);
    Serial.println(" cm | Valve: OPEN");
  } else {
    digitalWrite(RELAY_PIN, LOW); // Cutoff flow
    Serial.println("[IDLE] No cup present in chamber");
  }

  delay(200); // 5Hz sampling cycle
}</code></pre>
        </div>

    </div>

    <!-- Script Logic -->
    <script>
        let distance = 6.5;
        let cupLevel = 0; // 0 to 100%
        let isFlowing = false;
        let totalVolume = 0;
        let flowTimer = null;
        let serialInterval = null;

        function onDistanceChange(val) {
            distance = parseFloat(val);
            document.getElementById('distVal').textContent = distance.toFixed(1);
            evaluateState();
        }

        function setSlider(val) {
            document.getElementById('distanceSlider').value = val;
            onDistanceChange(val);
        }

        function emptyCup() {
            cupLevel = 0;
            document.getElementById('cupWaterLevel').style.height = '0%';
            document.getElementById('cupPercentBadge').textContent = '0%';
            evaluateState();
        }

        function evaluateState() {
            const cupStage = document.getElementById('cupStage');
            const stream = document.getElementById('waterStream');
            const relayDot = document.getElementById('relayDot');
            const relayText = document.getElementById('relayText');
            const solenoidDot = document.getElementById('solenoidDot');
            const solenoidText = document.getElementById('solenoidText');
            const stateBadge = document.getElementById('dispenseStateBadge');
            const flowRate = document.getElementById('flowRateVal');

            // Visual cup position
            if (distance > 15) {
                cupStage.classList.add('away');
            } else {
                cupStage.classList.remove('away');
            }

            // Flow trigger criteria: distance <= 10.0 cm AND cup not 100% full
            if (distance <= 10.0 && cupLevel < 100) {
                isFlowing = true;
                stream.classList.add('flowing');
                relayDot.classList.add('active');
                relayText.textContent = "ACTIVE (5V)";
                relayText.style.color = "var(--neon-green)";

                solenoidDot.classList.add('active');
                solenoidText.textContent = "OPEN (12V)";
                solenoidText.style.color = "var(--neon-green)";

                stateBadge.textContent = "DISPENSING WATER";
                stateBadge.style.color = "#040810";
                stateBadge.style.background = "var(--neon-green)";

                flowRate.textContent = "1.85 L/m";

                if (!flowTimer) {
                    flowTimer = setInterval(tickFill, 80);
                }
            } else {
                isFlowing = false;
                stream.classList.remove('flowing');
                relayDot.classList.remove('active');
                relayText.textContent = "STANDBY";
                relayText.style.color = "#fff";

                solenoidDot.classList.remove('active');
                solenoidText.textContent = "CLOSED";
                solenoidText.style.color = "#fff";

                if (cupLevel >= 100) {
                    stateBadge.textContent = "AUTO-CUTOFF: FULL";
                    stateBadge.style.color = "var(--neon-yellow)";
                    stateBadge.style.background = "rgba(255, 204, 0, 0.15)";
                } else {
                    stateBadge.textContent = "STANDBY";
                    stateBadge.style.color = "var(--text-dim)";
                    stateBadge.style.background = "#1e293b";
                }

                flowRate.textContent = "0.00 L/m";

                if (flowTimer) {
                    clearInterval(flowTimer);
                    flowTimer = null;
                }
            }
        }

        function tickFill() {
            if (cupLevel < 100) {
                cupLevel += 1;
                totalVolume += 3; // mL
                document.getElementById('cupWaterLevel').style.height = cupLevel + '%';
                document.getElementById('cupPercentBadge').textContent = cupLevel + '%';
                document.getElementById('volumeVal').textContent = totalVolume + ' mL';
            } else {
                evaluateState(); // Trigger Auto-cutoff
            }
        }

        // Serial log generator
        function startSerialStream() {
            serialInterval = setInterval(() => {
                const now = new Date();
                const timeStr = `[${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')}:${String(now.getSeconds()).padStart(2,'0')}]`;
                const container = document.getElementById('serialOutput');

                const div = document.createElement('div');
                div.className = 'log-entry';

                if (isFlowing) {
                    div.innerHTML = `<span class="log-time">${timeStr}</span> <span class="log-active">[ECHO] Dist: ${distance.toFixed(1)}cm | RELAY: HIGH | SOLENOID: 1 | FILL: ${cupLevel}%</span>`;
                } else if (cupLevel >= 100) {
                    div.innerHTML = `<span class="log-time">${timeStr}</span> <span style="color:var(--neon-yellow);">[SAFETY] Capacity reached 100% | Solenoid Lock triggered</span>`;
                } else {
                    div.innerHTML = `<span class="log-time">${timeStr}</span> <span class="log-idle">[IDLE] Dist: ${distance.toFixed(1)}cm | THRESHOLD: &lt;10.0cm | Standby</span>`;
                }

                container.appendChild(div);
                container.scrollTop = container.scrollHeight;

                if (container.children.length > 30) {
                    container.removeChild(container.firstChild);
                }
            }, 800);
        }

        function clearSerial() {
            document.getElementById('serialOutput').innerHTML = '';
        }

        function toggleCode() {
            const content = document.getElementById('codeContent');
            const arrow = document.getElementById('codeToggleArrow');
            content.classList.toggle('open');
            arrow.textContent = content.classList.contains('open') ? '▲' : '▼';
        }

        // Initialize simulation
        evaluateState();
        startSerialStream();
    </script>
</body>
</html>
