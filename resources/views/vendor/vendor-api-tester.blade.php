<x-customer-layout>
    {{-- Main Wrapper with 100px Top & Bottom Margin (using padding for stability) --}}
    <div style="background-color: #000000 !important; color: #d4d4d8 !important; min-height: 100vh; width: 100vw; font-family: 'JetBrains Mono', monospace; position: absolute; top: 0; left: 0; overflow-y: auto; display: flex; flex-direction: column; padding: 100px 0 !important; box-sizing: border-box;">

        {{-- Main Terminal Box --}}
        <div style="max-width: 1600px; margin: 0 auto; width: 100%; border: 1px solid #1a1a1a; display: flex; flex-direction: column; background-color: #050505; flex: 1;">

            {{-- Header --}}
            <div style="background-color: #080808; border-bottom: 1px solid #1a1a1a; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; height: 60px;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="display: flex; gap: 8px;">
                        <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ff5f56;"></div>
                        <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #ffbd2e;"></div>
                        <div style="width: 12px; height: 12px; border-radius: 50%; background-color: #27c93f;"></div>
                    </div>
                    <h1 style="color: #fbbf24; font-size: 11px; font-weight: 900; letter-spacing: 3px;">AUTO_SCAN // VENDOR_MANIFEST</h1>
                </div>

                <div style="display: flex; gap: 15px; align-items: center;">
                    <div style="background: #000; border: 1px solid #222; border-radius: 4px; padding: 6px 15px; display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 10px; color: #444;">GATEWAY:</span>
                        <input type="text" id="api-domain" style="background: transparent; border: none; color: #fbbf24; font-size: 11px; width: 350px; outline: none;">
                    </div>
                    <button onclick="runExpedition()" style="background: #fbbf24; color: #000; border: none; padding: 8px 30px; border-radius: 2px; font-size: 10px; font-weight: 900; cursor: pointer;">EXECUTE_TX</button>
                </div>
            </div>

            <div style="display: flex; flex: 1; height: 75vh;">
                {{-- Sidebar --}}
                <aside style="width: 320px; border-right: 1px solid #1a1a1a; background-color: #050505; overflow-y: auto;">
                    <div style="padding: 25px;">
                        <p style="font-size: 9px; color: #333; font-weight: 900; letter-spacing: 2px; margin-bottom: 25px;">// SCANNED_ENDPOINTS</p>
                        @forelse($modules as $moduleName => $apis)
                            <div style="margin-bottom: 25px;">
                                <span style="color: #fbbf24; font-size: 10px; opacity: 0.4; text-transform: uppercase;">[{{ $moduleName }}]</span>
                                <div style="margin-top: 10px; display: flex; flex-direction: column; gap: 2px;">
                                    @foreach($apis as $api)
                                        <div onclick="setEndpoint('{{ $api['method'] }}', '{{ $api['path'] }}')"
                                             style="padding: 10px 15px; font-size: 11px; cursor: pointer; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; transition: 0.2s;"
                                             onmouseover="this.style.backgroundColor='#0a0a0a'; this.style.color='#fbbf24'"
                                             onmouseout="this.style.backgroundColor='transparent'; this.style.color='#666'">
                                            <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 180px;">{{ $api['label'] }}</span>
                                            <span style="font-size: 8px; font-weight: 800; color: {{ $api['method'] == 'GET' ? '#3b82f6' : '#fbbf24' }};">{{ $api['method'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <p style="color: #ef4444; font-size: 10px;">No Vendor APIs detected.</p>
                        @endforelse
                    </div>
                </aside>

                {{-- Main Console --}}
                <div style="flex: 1; display: flex; flex-direction: column; background-color: #000;">
                    <div style="padding: 15px 40px; border-bottom: 1px solid #111; background: #020202; display: flex; align-items: center; gap: 20px;">
                        <span id="method-tag" style="background: #fbbf24; color: #000; font-size: 10px; font-weight: 900; padding: 3px 10px;">POST</span>
                        <div style="font-size: 13px; color: #444;">
                            curl -X CMD <span id="display-path" contenteditable="true" style="color: #fbbf24; outline: none; border-bottom: 1px solid #222;">v1/vendor/login</span>
                        </div>
                    </div>

                    <div style="flex: 1; display: flex; overflow: hidden;">
                        {{-- Request Area --}}
                        <div style="flex: 1; border-right: 1px solid #0a0a0a; display: flex; flex-direction: column;">
                            <div style="padding: 10px 30px; font-size: 9px; color: #222; font-weight: bold; background: #050505;">>> JSON_INPUT_BUFFER</div>
                            <textarea id="payload-input" spellcheck="false" style="flex: 1; background: transparent; border: none; padding: 40px; color: #fbbf24; font-size: 14px; outline: none; line-height: 1.8; resize: none;" placeholder="// Ready for manual injection..."></textarea>
                        </div>

                        {{-- Response Area --}}
                        <div style="flex: 1; display: flex; flex-direction: column; background-color: #010101;">
                            <div style="padding: 10px 30px; font-size: 9px; color: #222; font-weight: bold; background: #050505;">>> TELEMETRY_STREAM</div>
                            <pre id="response-box" style="flex: 1; padding: 40px; font-size: 14px; color: #fbbf24; overflow: auto; margin: 0; line-height: 1.8; white-space: pre-wrap;">[status] Awaiting execution signal...</pre>
                        </div>
                    </div>

                    {{-- Bottom Token Bar --}}
                    <div style="padding: 20px 40px; border-top: 1px solid #111; background: #050505; display: flex; flex-direction: column; gap: 10px;">
                        <label style="font-size: 9px; color: #333; font-weight: bold; letter-spacing: 1px;">ACTIVE_ACCESS_CIPHER</label>
                        <textarea id="api-token" style="width: 100%; height: 50px; background: #000; border: 1px solid #1a1a1a; color: #fbbf24; font-size: 10px; padding: 12px; outline: none; resize: none;" placeholder="TOKEN_NULL"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const domainInput = document.getElementById('api-domain');
            const tokenInput = document.getElementById('api-token');
            const pathDisplay = document.getElementById('display-path');
            const responseBox = document.getElementById('response-box');
            const payloadInput = document.getElementById('payload-input');

            // 1. Restore persistent data
            if (sessionStorage.getItem('api_domain')) domainInput.value = sessionStorage.getItem('api_domain');
            else domainInput.value = window.location.origin + '/api/';

            if (sessionStorage.getItem('api_token')) tokenInput.value = sessionStorage.getItem('api_token');
            if (sessionStorage.getItem('api_path')) pathDisplay.innerText = sessionStorage.getItem('api_path');
            if (sessionStorage.getItem('last_response')) responseBox.innerText = sessionStorage.getItem('last_response');

            // 2. Restore Payload for the current active path
            const currentPath = pathDisplay.innerText;
            if (sessionStorage.getItem('payload_' + currentPath)) {
                payloadInput.value = sessionStorage.getItem('payload_' + currentPath);
            }

            // --- Event Listeners for Real-time Saving ---

            domainInput.addEventListener('input', (e) => sessionStorage.setItem('api_domain', e.target.value));
            tokenInput.addEventListener('input', (e) => sessionStorage.setItem('api_token', e.target.value));

            // Save payload as you type (path-specific)
            payloadInput.addEventListener('input', (e) => {
                const path = document.getElementById('display-path').innerText;
                sessionStorage.setItem('payload_' + path, e.target.value);
            });

            pathDisplay.addEventListener('input', (e) => {
                const newPath = e.target.innerText;
                sessionStorage.setItem('api_path', newPath);
                // Agar edited path ke liye koi purana data hai toh load karlo
                if (sessionStorage.getItem('payload_' + newPath)) {
                    payloadInput.value = sessionStorage.getItem('payload_' + newPath);
                }
            });
        });

        function setEndpoint(method, path) {
            const tag = document.getElementById('method-tag');
            const payloadInput = document.getElementById('payload-input');

            tag.innerText = method;
            tag.style.background = method === 'GET' ? '#1d4ed8' : '#fbbf24';
            tag.style.color = method === 'GET' ? '#fff' : '#000';

            document.getElementById('display-path').innerText = path;
            sessionStorage.setItem('api_path', path);

            // CHECK: Agar is path ke liye user ne pehle kuch likha tha, toh wahi dikhao
            const savedPayload = sessionStorage.getItem('payload_' + path);

            if (savedPayload) {
                payloadInput.value = savedPayload;
            } else {
                // Default behavior if no history
                payloadInput.value = (method === 'POST' || method === 'PUT') ? '{\n    \n}' : '// GET_MODE_ACTIVE';
            }

            document.getElementById('response-box').innerText = '[system] buffer loaded from session.';
        }

        async function runExpedition() {
            const domain = document.getElementById('api-domain').value;
            const path = document.getElementById('display-path').innerText;
            const method = document.getElementById('method-tag').innerText;
            const token = document.getElementById('api-token').value;
            const body = document.getElementById('payload-input').value;
            const responseBox = document.getElementById('response-box');

            // Execute hone se pehle current body save karlo
            sessionStorage.setItem('payload_' + path, body);

            responseBox.innerText = 'Transmitting signal...';

            try {
                const res = await fetch(domain + path, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': token ? `Bearer ${token}` : ''
                    },
                    body: (method !== 'GET' && !body.startsWith('//')) ? body : null
                });

                const data = await res.json();
                const formatted = JSON.stringify(data, null, 4);

                responseBox.innerText = formatted;
                sessionStorage.setItem('last_response', formatted);

                if (data.token || (data.data && data.data.token)) {
                    const t = data.token || data.data.token;
                    document.getElementById('api-token').value = t;
                    sessionStorage.setItem('api_token', t);
                }
            } catch (err) {
                const errorText = 'FATAL_ERROR: ' + err.message;
                responseBox.innerText = errorText;
                sessionStorage.setItem('last_response', errorText);
            }
        }
    </script>
</x-customer-layout>
