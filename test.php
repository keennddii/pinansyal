<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment API Tester</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="url"] {
            background-color: #f9f9f9;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        button.clear {
            background-color: #f44336;
        }
        button.clear:hover {
            background-color: #da190b;
        }
        .response {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        .info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
        }
        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .status.success {
            background-color: #28a745;
            color: white;
        }
        .status.error {
            background-color: #dc3545;
            color: white;
        }
        .buttons {
            margin-top: 20px;
        }
        .example-data {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Payment API Tester</h1>
        <p>Test your payment POST API from localhost to domain</p>

        <form id="apiForm">
            <div class="form-group">
                <label for="apiUrl">API Endpoint URL:</label>
                <input type="url" id="apiUrl" placeholder="https://yourdomain.com/api/payments.php" required>
                <div class="example-data">
                    Example: https://yourdomain.com/api/payments.php
                </div>
            </div>

            <h2>Payment Data</h2>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" step="0.01" min="0.01" value="1000.50" required>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" required>
            </div>

            <div class="form-group">
                <label for="reference">Reference Number:</label>
                <input type="text" id="reference" placeholder="REF123456" required>
            </div>

            <div class="form-group">
                <label for="customer">Customer Name:</label>
                <input type="text" id="customer" placeholder="Juan Dela Cruz" required>
            </div>

            <div class="form-group">
                <label for="method">Payment Method:</label>
                <select id="method" required>
                    <option value="">Select payment method</option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="GCash">GCash</option>
                    <option value="PayMaya">PayMaya</option>
                    <option value="PayPal">PayPal</option>
                </select>
            </div>

            <div class="buttons">
                <button type="submit">📤 Send Payment Data</button>
                <button type="button" class="clear" onclick="clearResponse()">🗑️ Clear Response</button>
                <button type="button" onclick="generateSampleData()">🎲 Generate Sample Data</button>
            </div>
        </form>

        <div id="response"></div>
    </div>

    <script>
        // Set today's date as default
        document.getElementById('date').value = new Date().toISOString().split('T')[0];

        // Generate random reference number on load
        generateSampleData();

        document.getElementById('apiForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const apiUrl = document.getElementById('apiUrl').value;
            const responseDiv = document.getElementById('response');
            
            // Collect form data
            const paymentData = {
                amount: parseFloat(document.getElementById('amount').value),
                date: document.getElementById('date').value,
                reference_number: document.getElementById('reference').value,
                customer_name: document.getElementById('customer').value,
                payment_method: document.getElementById('method').value
            };

            // Show loading
            responseDiv.innerHTML = '<div class="info">⏳ Sending request to: ' + apiUrl + '</div>';

            try {
                const startTime = performance.now();
                
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(paymentData)
                });

                const endTime = performance.now();
                const responseTime = Math.round(endTime - startTime);

                let responseData;
                const contentType = response.headers.get('content-type');
                
                if (contentType && contentType.includes('application/json')) {
                    responseData = await response.json();
                } else {
                    const textData = await response.text();
                    responseData = { 
                        raw_response: textData,
                        note: "Response is not JSON format"
                    };
                }

                // Display response
                const statusClass = response.ok ? 'success' : 'error';
                const statusText = response.ok ? 'SUCCESS' : 'ERROR';
                
                responseDiv.innerHTML = `
                    <h2>📡 API Response</h2>
                    <div class="status ${statusClass}">
                        Status: ${response.status} ${response.statusText} (${statusText})
                    </div>
                    <p><strong>Response Time:</strong> ${responseTime}ms</p>
                    <p><strong>Content-Type:</strong> ${contentType || 'Not specified'}</p>
                    <div class="${statusClass}">
                        <strong>Response Data:</strong>
                        ${JSON.stringify(responseData, null, 2)}
                    </div>
                    <div class="info">
                        <strong>Sent Data:</strong>
                        ${JSON.stringify(paymentData, null, 2)}
                    </div>
                `;

            } catch (error) {
                responseDiv.innerHTML = `
                    <h2>❌ Connection Error</h2>
                    <div class="error">
                        <strong>Error:</strong> ${error.message}
                        
                        <strong>Possible causes:</strong>
                        • CORS policy blocking the request
                        • API endpoint is not accessible
                        • Network connectivity issues
                        • SSL certificate problems
                        • Server is down
                        
                        <strong>Troubleshooting:</strong>
                        1. Check if the API URL is correct
                        2. Verify your PHP API is running
                        3. Check browser console for CORS errors
                        4. Test the API directly with curl or Postman
                    </div>
                `;
            }
        });

        function generateSampleData() {
            const randomRef = 'REF' + Date.now();
            const customers = ['Juan Dela Cruz', 'Maria Santos', 'Jose Rizal', 'Ana Garcia', 'Pedro Martinez'];
            const randomCustomer = customers[Math.floor(Math.random() * customers.length)];
            
            document.getElementById('reference').value = randomRef;
            document.getElementById('customer').value = randomCustomer;
            document.getElementById('amount').value = (Math.random() * 5000 + 100).toFixed(2);
        }

        function clearResponse() {
            document.getElementById('response').innerHTML = '';
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('apiForm').dispatchEvent(new Event('submit'));
            }
        });
    </script>
</body>
</html>