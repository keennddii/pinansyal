<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Code by : www.codeinfoweb.com -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>Finavise Dashboard</title>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Itim&display=swap");
      body {
        font-family: "Itim", cursive;
      }
    </style>
  </head>
  <body class="bg-gray-900 text-gray-100 overflow-x-clip">
    <!-- Header Section -->
    <header class="p-4 flex justify-between items-center">
      <div class="flex items-center gap-2">
        <button
          id="menuButton"
          class="text-gray-100 text-3xl lg:hidden hover:text-gray-400"
          aria-label="Open Menu"
        >
          <i class="bx bx-menu"></i>
        </button>
        <div class="flex items-center gap-2 text-teal-400 cursor-pointer">
          <i class="bx bx-infinite text-3xl"></i>
          <span class="text-xl font-semibold">Finavise</span>
        </div>
      </div>

      <div class="flex items-center">
        <div class="relative hidden lg:flex w-[500px]">
          <input
            type="text"
            placeholder="Search..."
            class="w-full py-2 pl-10 pr-4 bg-gray-800 border border-gray-600 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500"
          />
          <i
            class="bx bx-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
          ></i>
        </div>
      </div>
      <div class="flex items-center gap-2">
        <span class="text-gray-300 font-medium">John Doe</span>
        <img
          src="../src/user.png"
          alt="User Avatar"
          class="w-10 h-10 rounded-full border border-gray-600"
        />
      </div>
    </header>

    <div class="flex p-3 gap-4">
      <!-- Sidebar Section -->
      <aside
        id="sidebar"
        class="w-42 hidden lg:block rounded-lg bg-gray-800 p-2 py-5 fixed lg:relative lg:translate-x-0 transform -translate-x-full transition-transform duration-200 ease-in-out"
      >
        <nav class="space-y-4">
          <a
            href="#"
            class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 p-3 rounded-md"
          >
            <i class="bx bx-home-alt text-teal-400"></i>
            <span>Dashboard</span>
          </a>
          <a
            href="#"
            class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 p-3 rounded-md"
          >
            <i class="bx bx-line-chart text-teal-400"></i>
            <span>Analytics</span>
          </a>
          <a
            href="#"
            class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 p-3 rounded-md"
          >
            <i class="bx bx-wallet text-teal-400"></i>
            <span>Transactions</span>
          </a>
          <a
            href="#"
            class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 p-3 rounded-md"
          >
            <i class="bx bx-user text-teal-400"></i>
            <span>Account</span>
          </a>
          <a
            href="#"
            class="flex items-center space-x-3 text-gray-300 hover:bg-gray-700 p-3 rounded-md"
          >
            <i class="bx bx-cog text-teal-400"></i>
            <span>Settings</span>
          </a>
        </nav>
      </aside>

      <!-- Main Section -->
      <main
        class="flex-1 bg-gray-900 flex gap-4 flex-col lg:flex-row ml-0 lg:ml-42"
      >
        <section
          class="w-full lg:flex-1 p-4 space-y-6 bg-gray-800 flex flex-col rounded-lg"
        >
          <!-- Revenue Flow Card (full width) -->
          <div class="bg-gray-700 p-5 rounded-md">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center space-x-3">
                <i class="bx bx-trending-up text-teal-400 text-2xl"></i>
                <h2 class="text-lg font-semibold text-gray-100">
                  Revenue Flow
                </h2>
              </div>
              <span class="text-xl font-bold text-gray-100">$24,300</span>
            </div>
            <canvas id="revenueFlowChart" class="w-full"></canvas>
          </div>

          <div class="flex gap-4 flex-col md:flex-row">
            <!-- Income Card with Growth -->
            <div
              class="bg-gray-700 p-5 flex-1 rounded-md flex items-center justify-between"
            >
              <div
                class="flex md:items-center gap-2 flex-col lg:flex-row items-start"
              >
                <i class="bx bx-dollar-circle text-teal-400 text-2xl"></i>
                <h2 class="text-sm md:text-lg font-semibold text-gray-100">
                  Income
                </h2>
              </div>
              <div
                class="text-xl font-bold text-gray-100 flex flex-col items-end lg:flex-row lg:items-center gap-2"
              >
                <span class="text-sm lg:text-lg">$15,200</span>
                <span class="text-green-400 text-sm">+8%</span>
              </div>
            </div>

            <!-- Expense Card with Growth -->
            <div
              class="bg-gray-700 p-4 md:p-5 flex-1 rounded-md flex items-center justify-between"
            >
              <div
                class="flex md:items-center gap-2 flex-col lg:flex-row items-start"
              >
                <i class="bx bx-cart text-teal-400 text-2xl"></i>
                <h2 class="text-sm md:text-lg font-semibold text-gray-100">
                  Expenses
                </h2>
              </div>
              <div
                class="text-xl font-bold text-gray-100 flex flex-col items-end lg:flex-row lg:items-center gap-2"
              >
                <span class="text-sm lg:text-lg">$6,700</span>
                <span class="text-red-400 text-sm">-5%</span>
              </div>
            </div>
          </div>
        </section>

        <!-- Right Side Content -->
        <section
          class="w-full lg:w-[300px] p-4 flex flex-col justify-between gap-4 bg-gray-800 rounded-lg"
        >
          <!-- Credit Card -->
          <div
            class="bg-gradient-to-r from-teal-500 to-blue-600 p-5 rounded-lg text-white"
          >
            <h3 class="text-xl font-semibold mb-2">Credit Card</h3>
            <p class="text-sm mb-4">Valid Thru: 12/25</p>
            <div class="mb-6">
              <span class="block text-lg font-bold tracking-wide"
                >•••• •••• •••• 1234</span
              >
            </div>
            <div class="flex justify-between">
              <div>
                <span class="text-xs uppercase text-gray-200">Card Holder</span>
                <p class="text-lg font-medium">John Doe</p>
              </div>
              <div>
                <span class="text-xs uppercase text-gray-200">Balance</span>
                <p class="text-lg font-medium">$5,300</p>
              </div>
            </div>
          </div>

          <!-- Available Balance with Pie Chart -->
          <div class="bg-gray-700 p-5 rounded-md overflow-hidden">
            <div class="flex items-center justify-between mb-4">
              <i class="bx bx-wallet text-teal-400 text-2xl"></i>
              <h2 class="text-lg font-semibold text-gray-100">Available</h2>
            </div>
            <div class="flex justify-center px-10 overflow-hidden">
              <canvas
                id="availableBalanceChart"
                class="w-20 md:w-32 lg:w-40"
              ></canvas>
            </div>
          </div>
        </section>
      </main>
    </div>

    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="practice.js"></script>
  </body>
</html>