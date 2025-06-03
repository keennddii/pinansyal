<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund Request API Tester</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .content {
            padding: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            font-size: 0.95rem;
        }

        input, select, textarea {
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            transform: translateY(-1px);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-test {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-test:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-clear {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .btn-clear:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .response-section {
            margin-top: 40px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 5px solid #4CAF50;
        }

        .response-section h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.3rem;
        }

        .response-content {
            background: #2d3748;
            color: #e2e8f0;
            padding: 20px;
            border-radius: 10px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.6;
            overflow-x: auto;
            white-space: pre-wrap;
            max-height: 300px;
            overflow-y: auto;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4CAF50;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .status-success {
            border-left-color: #4CAF50;
        }

        .status-error {
            border-left-color: #f44336;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 API Tester</h1>
            <p>Test your Fund Request API endpoint</p>
        </div>
        
        <div class="content">
            <form id="testForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="department">Department *</label>
                        <select id="department" required>
                            <option value="">Select Department</option>
                            <option value="IT">IT</option>
                            <option value="Finance">Finance</option>
                            <option value="HR">HR</option>
                            <option value="Operations">Operations</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="payee">Payee *</label>
                        <input type="text" id="payee" placeholder="Enter payee name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount">Amount *</label>
                        <input type="number" id="amount" step="0.01" min="0" placeholder="0.00" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="request_type">Request Type *</label>
                        <select id="request_type" required>
                            <option value="">Select Type</option>
                            <option value="purchase">Purchase</option>
                            <option value="reimbursement">Reimbursement</option>
                            <option value="advance">Cash Advance</option>
                            <option value="petty_cash">Petty Cash</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="requested_by">Requested By *</label>
                        <input type="text" id="requested_by" placeholder="Your name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="request_date">Request Date *</label>
                        <input type="date" id="request_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="reference_id">Reference ID (Optional)</label>
                        <input type="text" id="reference_id" placeholder="REF-2025-001">
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="purpose">Purpose *</label>
                        <textarea id="purpose" placeholder="Describe the purpose of this fund request..." required></textarea>
                    </div>
                </div>
                
                <div class="button-group">
                    <button type="submit" class="btn-test">🧪 Test API</button>
                    <button type="button" class="btn-clear" onclick="clearForm()">🗑️ Clear Form</button>
                </div>
            </form>
            
            <div class="loading" id="loading">
                <div class="spinner"></div>
                <p>Testing your API...</p>
            </div>
            
            <div class="response-section" id="responseSection" style="display: none;">
                <h3>📊 API Response</h3>
                <div class="response-content" id="responseContent"></div>
            </div>
        </div>
    </div>

    <script>
        // Set today's date as default
        document.getElementById('request_date').valueAsDate = new Date();
        
        // Fill sample data
        function fillSampleData() {
            document.getElementById('department').value = 'IT';
            document.getElementById('payee').value = 'John Doe';
            document.getElementById('amount').value = '1500.00';
            document.getElementById('request_type').value = 'purchase';
            document.getElementById('requested_by').value = 'Jane Manager';
            document.getElementById('reference_id').value = 'REF-2025-001';
            document.getElementById('purpose').value = 'Purchase new laptops for development team';
        }
        
        // Load sample data on page load
        fillSampleData();
        
        document.getElementById('testForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const loading = document.getElementById('loading');
            const responseSection = document.getElementById('responseSection');
            const responseContent = document.getElementById('responseContent');
            
            // Show loading
            loading.style.display = 'block';
            responseSection.style.display = 'none';
            
            // Collect form data
            const formData = {
                department: document.getElementById('department').value,
                payee: document.getElementById('payee').value,
                amount: parseFloat(document.getElementById('amount').value),
                purpose: document.getElementById('purpose').value,
                request_type: document.getElementById('request_type').value,
                reference_id: document.getElementById('reference_id').value || null,
                requested_by: document.getElementById('requested_by').value,
                request_date: document.getElementById('request_date').value
            };
            
            try {
                const response = await fetch('api/request-fund.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                });
                
                const result = await response.json();
                
                // Hide loading
                loading.style.display = 'none';
                
                // Show response
                responseSection.style.display = 'block';
                responseSection.className = response.ok ? 'response-section status-success' : 'response-section status-error';
                
                responseContent.textContent = JSON.stringify({
                    status: response.status,
                    statusText: response.statusText,
                    data: result
                }, null, 2);
                
            } catch (error) {
                // Hide loading
                loading.style.display = 'none';
                
                // Show error
                responseSection.style.display = 'block';
                responseSection.className = 'response-section status-error';
                responseContent.textContent = JSON.stringify({
                    error: 'Network Error',
                    message: error.message,
                    details: 'Could not connect to the API endpoint'
                }, null, 2);
            }
        });
        
        function clearForm() {
            document.getElementById('testForm').reset();
            document.getElementById('request_date').valueAsDate = new Date();
            document.getElementById('responseSection').style.display = 'none';
        }
    </script>
</body>
</html>