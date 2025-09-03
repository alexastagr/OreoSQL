<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="icon" type="image/svg+xml" href="https://www.svgrepo.com/show/417539/oreo-biscuit.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OreoSQL</title>

    <link rel="stylesheet" href="./oreo.css">
    <!-- HugeIcons, jQuery, TailwindCSS -->
    <link rel="stylesheet" href="https://use.hugeicons.com/font/icons.css">
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>

<body x-data="oreoApp()" x-init="checkSession()" x-cloak class="bg-[#2c2626] min-h-screen flex items-center justify-center p-8">


    <template x-if="!loading">
        <div>

            <!-- start main auth screen -->
            <div x-show="!loggedIn" class="bg-white p-12 rounded-xl shadow-md max-w-80 w-full mx-auto px-8">


                <div x-show="errorbar.open"
                    x-transition
                    class="fixed top-4 right-4 px-4 py-2 rounded shadow text-white"
                    :class="errorbar.isError ? 'bg-red-600' : 'bg-green-600'">
                    <span x-text="errorbar.message"></span>
                    <button @click="errorbar.open=false" class="ml-2 font-bold">×</button>
                </div>


                <!-- logo area -->
                <div class="logoarea flex flex-col relative justify-center text-white items-center mb-5 gap-2">
                    <div class="left">
                        <svg viewBox="-5.76 0 138.145 138.145" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="oreo_biscuit" data-name="oreo biscuit" transform="translate(-590.519 469.1)">
                                    <path id="path144" d="M715.172-395.306a60.528,60.528,0,0,1-60.527,60.528,60.529,60.529,0,0,1-60.528-60.528,60.529,60.529,0,0,1,60.528-60.532,60.528,60.528,0,0,1,60.527,60.532" fill="#e9ecef"></path>
                                    <path id="path146" d="M714.362-406.682a60.528,60.528,0,0,1-60.527,60.529,60.528,60.528,0,0,1-60.528-60.529,60.529,60.529,0,0,1,60.528-60.53,60.529,60.529,0,0,1,60.527,60.53" fill="#7a383f"></path>
                                    <path id="path148" d="M672.722-410.819c-.269-1.216-7.373-5.128-7.373-5.128L651.98-417.3l-14.2,4.452-3.912,9.941,6.071,5.3,12.04,2.293,16.7-2.428,4.047-6.88a46.681,46.681,0,0,0,0-6.205" fill="#92444d"></path>
                                    <path id="path150" d="M618.895-426.212l-4.723,10.131,11.173,3.1,1.509-9.579-7.96-3.656" fill="#92444d"></path>
                                    <path id="path152" d="M645.942-433.484h-11.2v-9.376h11.2v9.376" fill="#92444d"></path>
                                    <path id="path154" d="M671.642-432.744H662.4v-10.791h9.24v10.791" fill="#92444d"></path>
                                    <path id="path156" d="M690.328-414.53H679.8v-9.984h10.524v9.984" fill="#92444d"></path>
                                    <path id="path158" d="M691.609-387.65H681.086v-9.984h10.523v9.984" fill="#92444d"></path>
                                    <path id="path160" d="M672.234-369.42H661.71V-379.4h10.524v9.983" fill="#92444d"></path>
                                    <path id="path162" d="M645.47-369.075H634.948v-9.983H645.47v9.983" fill="#92444d"></path>
                                    <path id="path164" d="M627.385-388.223H616.861v-9.984h10.524v9.984" fill="#92444d"></path>
                                    <path id="path166" d="M694.538-353.57a57.512,57.512,0,0,1-18.3,12.341,57.273,57.273,0,0,1-22.4,4.519,57.234,57.234,0,0,1-22.4-4.519,57.474,57.474,0,0,1-18.3-12.341,57.42,57.42,0,0,1-11.427-16.268,63.238,63.238,0,0,0,52.13,27.373,63.256,63.256,0,0,0,52.129-27.369A57.345,57.345,0,0,1,694.538-353.57ZM602.6-432.043l4.932,2.849h0a2.871,2.871,0,0,0,3.929-1.053,2.871,2.871,0,0,0-1.049-3.929l-4.933-2.851a57.088,57.088,0,0,1,5.671-7.368l4.023,4.017a2.871,2.871,0,0,0,4.068,0,2.874,2.874,0,0,0,0-4.069l-4.017-4.021a57.08,57.08,0,0,1,7.368-5.669l2.851,4.932a2.872,2.872,0,0,0,3.929,1.051,2.872,2.872,0,0,0,1.053-3.929l-2.848-4.933q1.89-.974,3.856-1.8c1.56-.659,3.141-1.24,4.743-1.759l1.476,5.5a2.882,2.882,0,0,0,3.524,2.041,2.879,2.879,0,0,0,2.032-3.529l-1.475-5.5a57.332,57.332,0,0,1,9.224-1.205v5.688a2.882,2.882,0,0,0,2.884,2.88,2.88,2.88,0,0,0,2.875-2.88v-5.688a57.31,57.31,0,0,1,9.225,1.205l-1.476,5.5h0v0a2.876,2.876,0,0,0,2.036,3.525,2.882,2.882,0,0,0,3.525-2.041s0,0,0-.008l1.472-5.493c1.6.519,3.183,1.1,4.74,1.759q1.964.834,3.856,1.8l-2.849,4.933h0a2.879,2.879,0,0,0,1.053,3.929,2.869,2.869,0,0,0,3.929-1.051l.005,0,2.845-4.928a57.737,57.737,0,0,1,7.373,5.669l-4.019,4.021h0a2.875,2.875,0,0,0,0,4.069,2.872,2.872,0,0,0,4.069,0l0,0,4.013-4.013a56.968,56.968,0,0,1,5.671,7.368l-4.929,2.851h0a2.873,2.873,0,0,0-1.053,3.929,2.87,2.87,0,0,0,3.928,1.053h.009l4.924-2.849q.974,1.89,1.8,3.857.988,2.338,1.763,4.744l-5.505,1.473h0a2.882,2.882,0,0,0-2.036,3.527,2.876,2.876,0,0,0,3.529,2.031h0l5.5-1.476a57.382,57.382,0,0,1,1.205,9.225h-5.688a2.881,2.881,0,0,0-2.88,2.879,2.883,2.883,0,0,0,2.884,2.88h5.684a57.32,57.32,0,0,1-1.205,9.224l-5.5-1.475h0a2.873,2.873,0,0,0-3.524,2.035,2.882,2.882,0,0,0,2.036,3.527h0l5.505,1.471c-.517,1.6-1.1,3.188-1.763,4.748q-.834,1.958-1.8,3.851l-4.939-2.848h0a2.877,2.877,0,0,0-3.928,1.055,2.872,2.872,0,0,0,1.053,3.928h0l4.929,2.851a57.068,57.068,0,0,1-5.671,7.369l-4.017-4.015h0a2.875,2.875,0,0,0-4.069,0,2.875,2.875,0,0,0,0,4.069h0l4.019,4.017a57.515,57.515,0,0,1-7.373,5.671l-2.851-4.929h0a2.872,2.872,0,0,0-3.929-1.053,2.878,2.878,0,0,0-1.053,3.929h0l2.849,4.933q-1.89.972-3.856,1.8c-1.557.659-3.143,1.244-4.74,1.763l-1.475-5.505h0a2.883,2.883,0,0,0-3.525-2.037A2.874,2.874,0,0,0,664.464-355v0l1.476,5.5a57.014,57.014,0,0,1-9.225,1.205v-5.687a2.88,2.88,0,0,0-2.875-2.88,2.882,2.882,0,0,0-2.884,2.88v5.687a57.032,57.032,0,0,1-9.224-1.205l1.475-5.5v0a2.867,2.867,0,0,0-2.032-3.52,2.874,2.874,0,0,0-3.524,2.032h0l-1.476,5.505q-2.4-.778-4.743-1.763-1.966-.834-3.856-1.8l2.848-4.932v0a2.871,2.871,0,0,0-1.053-3.929,2.876,2.876,0,0,0-3.929,1.053h0l-2.851,4.933a57.478,57.478,0,0,1-7.368-5.675l4.017-4.017h0a2.874,2.874,0,0,0,0-4.069,2.87,2.87,0,0,0-4.068,0h0l-4.023,4.017a57.4,57.4,0,0,1-5.671-7.372l4.929-2.851h0a2.87,2.87,0,0,0,1.049-3.928,2.877,2.877,0,0,0-3.929-1.055h0l-4.932,2.848q-.974-1.89-1.8-3.851c-.659-1.56-1.24-3.147-1.759-4.744l5.5-1.475h0a2.883,2.883,0,0,0,2.041-3.527,2.879,2.879,0,0,0-3.529-2.035h0l-5.5,1.475a57.131,57.131,0,0,1-1.205-9.224h5.691a2.881,2.881,0,0,0,2.876-2.88,2.88,2.88,0,0,0-2.876-2.879h-5.691a57.224,57.224,0,0,1,1.205-9.225l5.5,1.476h.008a2.876,2.876,0,0,0,3.525-2.031,2.88,2.88,0,0,0-2.041-3.527h0l-5.5-1.473c.519-1.6,1.1-3.185,1.759-4.744q.834-1.966,1.8-3.857Zm114.553,26.26A63.317,63.317,0,0,0,653.836-469.1a63.315,63.315,0,0,0-63.317,63.317c0,1.944.091,3.868.26,5.763-.169,1.893-.26,3.813-.26,5.752a63.314,63.314,0,0,0,63.317,63.313,63.316,63.316,0,0,0,63.317-63.313c0-1.939-.092-3.853-.26-5.743q.258-2.854.26-5.772" fill="#100f0d"></path>
                                    <path id="path168" d="M640.7-411.082a25.373,25.373,0,0,1,13.137-3.333,25.35,25.35,0,0,1,13.129,3.333c2.555,1.6,4.016,3.533,4.016,5.3s-1.461,3.7-4.016,5.3a25.338,25.338,0,0,1-13.129,3.336,25.361,25.361,0,0,1-13.137-3.336c-2.551-1.6-4.012-3.533-4.012-5.3S638.152-409.479,640.7-411.082Zm-9.772,5.3c0,7.948,10.253,14.389,22.909,14.389s22.9-6.441,22.9-14.389-10.253-14.388-22.9-14.388-22.909,6.441-22.909,14.388" fill="#100f0d"></path>
                                    <path id="path170" d="M645.2-402.9H662.47a2.874,2.874,0,0,0,2.035-.844,2.883,2.883,0,0,0,0-4.072,2.878,2.878,0,0,0-2.035-.843H645.2a2.884,2.884,0,0,0-2.036.843,2.885,2.885,0,0,0,0,4.072,2.88,2.88,0,0,0,2.036.844" fill="#100f0d"></path>
                                    <path id="path172" d="M651.8-387.379a2.878,2.878,0,0,0,0,4.068,2.88,2.88,0,0,0,4.072,0,2.88,2.88,0,0,0,0-4.068,2.875,2.875,0,0,0-4.072,0" fill="#100f0d"></path>
                                    <path id="path174" d="M655.872-424.176a2.885,2.885,0,0,0,0-4.072,2.885,2.885,0,0,0-4.072,0,2.883,2.883,0,0,0,0,4.072,2.885,2.885,0,0,0,4.072,0" fill="#100f0d"></path>
                                    <path id="path176" d="M655.872-444.04a2.882,2.882,0,0,0,0-4.069,2.875,2.875,0,0,0-4.072,0,2.879,2.879,0,0,0,0,4.069,2.878,2.878,0,0,0,4.072,0" fill="#100f0d"></path>
                                    <path id="path178" d="M651.8-367.523a2.878,2.878,0,0,0,0,4.068,2.878,2.878,0,0,0,4.072,0,2.88,2.88,0,0,0,0-4.068,2.878,2.878,0,0,0-4.072,0" fill="#100f0d"></path>
                                    <path id="path180" d="M625.345-431.394a2.88,2.88,0,0,0,2.879-2.879,2.88,2.88,0,0,0-2.879-2.88,2.879,2.879,0,0,0-2.879,2.88,2.879,2.879,0,0,0,2.879,2.879" fill="#100f0d"></path>
                                    <path id="path182" d="M682.326-380.171a2.881,2.881,0,0,0-2.879,2.883,2.879,2.879,0,0,0,2.879,2.876,2.879,2.879,0,0,0,2.879-2.876,2.881,2.881,0,0,0-2.879-2.883" fill="#100f0d"></path>
                                    <path id="path184" d="M615.577-403.747a2.88,2.88,0,0,0,0-4.072,2.884,2.884,0,0,0-4.069,0,2.878,2.878,0,0,0,0,4.072,2.879,2.879,0,0,0,4.069,0" fill="#100f0d"></path>
                                    <path id="path186" d="M692.094-407.819a2.878,2.878,0,0,0,0,4.072,2.878,2.878,0,0,0,4.068,0,2.875,2.875,0,0,0,0-4.072,2.883,2.883,0,0,0-4.068,0" fill="#100f0d"></path>
                                    <path id="path188" d="M625.345-380.171a2.88,2.88,0,0,0-2.879,2.883,2.878,2.878,0,0,0,2.879,2.876,2.879,2.879,0,0,0,2.879-2.876,2.881,2.881,0,0,0-2.879-2.883" fill="#100f0d"></path>
                                    <path id="path190" d="M682.326-431.394a2.88,2.88,0,0,0,2.879-2.879,2.88,2.88,0,0,0-2.879-2.88,2.88,2.88,0,0,0-2.879,2.88,2.88,2.88,0,0,0,2.879,2.879" fill="#100f0d"></path>
                                    <path id="path192" d="M683.992-396.4l5.32,2.2-2.2,5.32-5.32-2.2Zm-9.721,8.432,15.952,6.608,6.611-15.953-15.953-6.607-6.609,15.952" fill="#100f0d"></path>
                                    <path id="path194" d="M642.258-370.306l-5.316-2.2,2.2-5.32,5.321,2.2Zm-6.232-15.043L629.421-369.4l15.953,6.609,6.605-15.952-15.953-6.611" fill="#100f0d"></path>
                                    <path id="path196" d="M665.416-441.254l5.317,2.2-2.205,5.311-5.312-2.2Zm6.232,15.037,6.605-15.953L662.3-448.775l-6.607,15.952,15.953,6.607" fill="#100f0d"></path>
                                    <path id="path198" d="M665.416-370.306l-2.2-5.321,5.312-2.2,2.209,5.32Zm-9.721-8.432,6.607,15.952,15.952-6.609-6.605-15.953-15.953,6.611" fill="#100f0d"></path>
                                    <path id="path200" d="M642.258-441.254l2.205,5.315-5.321,2.2-2.2-5.311Zm9.721,8.431-6.605-15.952-15.953,6.605,6.605,15.953,15.953-6.607" fill="#100f0d"></path>
                                    <path id="path202" d="M623.68-415.154l-5.32-2.205,2.2-5.317,5.316,2.2Zm9.721-8.436L617.448-430.2l-6.605,15.952,15.952,6.607L633.4-423.59" fill="#100f0d"></path>
                                    <path id="path204" d="M687.112-422.676l2.2,5.317-5.32,2.205-2.2-5.321Zm-6.232,15.039,15.953-6.607L690.222-430.2,674.27-423.59l6.609,15.952" fill="#100f0d"></path>
                                    <path id="path206" d="M620.568-388.884l-2.205-5.317,5.317-2.2,2.2,5.313Zm6.227-15.039-15.952,6.607,6.605,15.953,15.953-6.608-6.607-15.952" fill="#100f0d"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="text-4xl flex flex-row mb-3">
                        <div class="text-[#7a383f] font-normal">Oreo</div>
                        <div class="text-black font-bold">SQL</div>
                    </div>


                    <p class="text-[#7a383f] text-[15px]">
                        A lightweight SQL management system
                    </p>
                </div>


                <!-- authform -->
                <form @submit.prevent="login">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="host" class="block text-sm font-normal text-black">Host</label>
                            <input type="text" x-model="loginForm.host" placeholder="localhost" class="mt-1 p-2  text-sm text-[#7a383f] w-full border border-[#7a383f] rounded-md" required>
                        </div>
                        <div>
                            <label for="db" class="block text-sm font-normal text-black">Database</label>
                            <input type="text" x-model="loginForm.db" placeholder="mydatabase" class="mt-1 p-2 w-full  text-sm text-[#7a383f] border border-[#7a383f] rounded-md" required>
                        </div>
                    </div>


                    <div class="mt-4">
                        <label for="user" class="block text-sm font-normal text-black">Username</label>
                        <input type="text" x-model="loginForm.user" placeholder="username" class="mt-1 p-2 w-full  text-sm border text-[#7a383f] border-[#7a383f] rounded-md" required>
                    </div>


                    <div class="mt-4">
                        <label for="pass" class="block text-sm font-normal text-black">Password</label>
                        <input type="password" x-model="loginForm.pass" placeholder="****" class="mt-1 p-2 w-full text-sm border text-[#7a383f] border-[#7a383f] rounded-md">
                    </div>


                    <div class="mt-4 flex flex-col gap-2">
                        <button type="submit"
                            class="w-full cursor-pointer p-2 bg-[#7a383f] text-white rounded-md hover:bg-black">Connect</button>
                        <button type="reset"
                            class="w-full cursor-pointer p-2 bg-black text-white rounded-md hover:opacity-80">Reset</button>
                    </div>
                </form>


            </div>
            <!-- end login screen -->


            <!-- start dashboard screen -->

            <div x-show="loggedIn" class="min-w-full min-h-full absolute left-0 top-0">

                <!-- start sidebar and hamburger -->
                <div x-data="{ sidebar: false }">
                    <!-- menu hamburger -->
                    <div
                        @click="sidebar = !sidebar"
                        :class="sidebar ? 'bg-[#b69296] text-white' : 'bg-white text-black'"
                        class="w-12 h-12 z-90 rounded-lg absolute top-30 right-5 flex flex-row justify-center items-center cursor-pointer">
                        <i class="hgi hgi-stroke hgi-menu-square"></i>
                    </div>

                    <!-- sidebar overlay -->
                    <template x-if="sidebar">
                        <div>

                            <!-- actual sidebar -->
                            <div
                                class="fixed top-20 left-0 w-70 h-full bg-[#F0F0F0] shadow-xl z-80 p-4"
                                x-show="sidebar"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="translate-x-full"
                                x-transition:enter-end="translate-x-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="translate-x-0"
                                x-transition:leave-end="translate-x-full">
                                <h2 class="text-lg font-bold mb-4">Database Actions</h2>
                                <ul>
                                    <li class="py-2 border-b">
                                        <div class="flex flex-row gap-2 items-center cursor-pointer hover:text-red-500">
                                            <span><i class="hgi hgi-stroke hgi-delete-03 mt-2"></i></span>
                                            <span>Drop Database</span>
                                        </div>
                                    </li>


                                    <li class="py-2 border-b">
                                        <div class="flex flex-row gap-2 items-center cursor-pointer hover:text-green-600">
                                            <span><i class="hgi hgi-stroke hgi-database-import mt-2"></i></span>
                                            <span>Export Database</span>
                                        </div>
                                    </li>


                                    <li @click="openImportModal" class="py-2 border-b">
                                        <div class="flex flex-row gap-2 items-center cursor-pointer hover:text-blue-600">
                                            <span><i class="hgi hgi-stroke hgi-database-export mt-2"></i></span>
                                            <span>Import Database</span>
                                        </div>
                                    </li>


                                    <li @click="logout" class="py-2 border-b">
                                        <div class="flex flex-row gap-2 items-center cursor-pointer hover:font-semibold">
                                            <span><i class="hgi hgi-stroke hgi-logout-04 mt-2"></i></span>
                                            <span>Logout Session</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- end sidebar and hamburger -->

                <!-- start import database window -->
                <div x-show="importWindow" class="flex h-screen w-full flex-col mt-10 items-center justify-center gap-y-2">


                    <div class="w-95 lg:w-[600px] rounded-xl border relative border-gray-200 bg-white py-4 px-2">
                        <!-- close file selector icon -->
                        <div @click="importWindow = false" class="w-6 h-6 bg-red-600 rounded-full text-white absolute top-6 right-5 flex justify-content items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7 7l10 10M7 17L17 7" />
                            </svg>
                        </div>

                        <div class="w-full py-9 bg-gray-50 rounded-2xl border border-gray-300 gap-3 grid border-dashed">
                            <div class="grid gap-1">
                                <svg class="mx-auto text-[#852C36]" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 16 16">
                                    <path fill="currentColor" fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM0 14.841a1.13 1.13 0 0 0 .401.823q.194.162.478.252c.284.09.411.091.665.091q.507 0 .858-.158q.355-.159.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357a2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176a.37.37 0 0 1-.143-.299q0-.234.184-.384q.187-.152.513-.152q.214 0 .37.068a.6.6 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566a1.2 1.2 0 0 0-.5-.41a1.8 1.8 0 0 0-.78-.152q-.44 0-.776.15q-.337.149-.528.421q-.19.273-.19.639q0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.325q0 .165-.085.29A.56.56 0 0 1 2 15.31q-.167.07-.413.07q-.176 0-.32-.04a.8.8 0 0 1-.248-.115a.58.58 0 0 1-.255-.384zm6.878 1.489l-.507-.739q.264-.243.401-.6q.138-.358.138-.806v-.501q0-.556-.208-.967a1.5 1.5 0 0 0-.589-.636q-.383-.225-.917-.225q-.527 0-.914.225q-.384.223-.592.636a2.14 2.14 0 0 0-.205.967v.5q0 .554.205.965q.208.41.592.636a1.8 1.8 0 0 0 .914.222a1.8 1.8 0 0 0 .6-.1l.294.422h.788ZM4.262 14.2v-.522q0-.369.114-.63a.9.9 0 0 1 .325-.398a.9.9 0 0 1 .495-.138q.288 0 .495.138a.9.9 0 0 1 .325.398q.115.261.115.63v.522q0 .246-.053.445q-.053.196-.155.34l-.106-.14l-.105-.147h-.733l.451.65a.6.6 0 0 1-.251.047a.87.87 0 0 1-.487-.147a.9.9 0 0 1-.32-.404a1.7 1.7 0 0 1-.11-.644m3.986 1.057h1.696v.674H7.457v-3.999h.79z" />
                                </svg>
                                <h2 class="text-center text-[#852C36] mt-5 text-lg leading-4">Select SQL file</h2>
                            </div>
                            <div class="grid gap-2">
                                <h4 class="text-center text-gray-900 text-sm font-medium leading-snug">Drag and Drop your file here or</h4>
                                <div class="flex items-center justify-center">
                                    <label>
                                        <input type="file" accept=".sql" hidden />
                                        <div class="flex w-28 h-9 px-2 flex-col bg-[#852C36] rounded-full shadow text-white text-xs font-semibold leading-4 items-center justify-center cursor-pointer focus:outline-none">Choose File</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- end import database window -->


                <!-- desktop icon list -->
                <div class="grid grid-rows-3 absolute top-40 left-8 gap-4 z-5">

                    <!-- tables icon -->
                    <div @click="tablesWindow = true" class="flex flex-col justify-center items-center gap-2 text-white cursor-pointer hover:opacity-80 ">
                        <div class="w-19 h-19 flex justify-center items-center">
                            <div class="w-15 h-15 ic-table text-white"></div>
                        </div>

                        <div class="text-md font-normal">
                            Show Tables
                        </div>
                    </div>
                </div>

                <!-- start confirmation modal -->

                <div x-show="modal.open"
                    class="fixed inset-0 flex items-center justify-center bg-black/50"
                    x-transition>
                    <div class="bg-white rounded shadow p-4 w-80" @click.away="modal.open=false">
                        <h3 class="font-bold mb-2">Confirmation</h3>
                        <p>
                            Are you sure you want to
                            <span x-text="modal.action"></span>
                            the table <b x-text="modal.table"></b>;
                        </p>
                        <div class="mt-4 flex justify-end space-x-2">
                            <button @click="modal.open=false">No, Cancel</button>
                            <button @click="doAction" class="bg-red-600 text-white px-3 py-1 rounded">
                                Yes, I'm sure
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end confirmation modal -->

                <!-- start tables area -->
                <div x-show="tablesWindow" class="flex h-screen w-full flex-col mt-10 items-center justify-center gap-y-2">
                    <div class="w-95 lg:w-[600px] rounded-xl border border-gray-200 bg-white py-4 px-2">
                        <div class="flex items-center justify-between px-2 text-base relative font-medium text-gray-700">
                            <div class="flex flex-row gap-2 text-lg font-bold">
                                <div>Table List :</div>
                                <div x-text="tables.length"></div>
                            </div>

                            <!-- close tables window -->
                            <div @click="tablesWindow = false" class="w-6 h-6 absolute cursor-pointer bottom-2 right-0 bg-red-600 rounded-full flex justify-center items-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24">
                                    <g fill="none" fill-rule="evenodd">
                                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                        <path fill="currentColor" d="m12 13.414l5.657 5.657a1 1 0 0 0 1.414-1.414L13.414 12l5.657-5.657a1 1 0 0 0-1.414-1.414L12 10.586L6.343 4.929A1 1 0 0 0 4.93 6.343L10.586 12l-5.657 5.657a1 1 0 1 0 1.414 1.414z" />
                                    </g>
                                </svg>
                            </div>

                        </div>
                        <div class="mt-4">
                            <div class="flex max-h-[400px] p-5 w-full flex-col overflow-y-scroll">
                                <template x-for="t in tables" :key="t">
                                    <button class="group flex items-center gap-x-5 rounded-md px-2.5 py-2 transition-all duration-75 hover:bg-[#FAE8E8]">


                                        <div class="grid grid-cols-3 gap-2">

                                            <!-- drop table -->

                                            <div @click="confirmAction('drop', t)" title=" Drop Table" class="flex h-7 w-7 items-center rounded-lg bg-red-500 text-black cursor-pointer">
                                                <div class="tag w-full h-full text-center font-medium text-white  flex flex-row justify-center items-center">
                                                    <i class="hgi hgi-stroke hgi-delete-01"></i>
                                                </div>
                                            </div>

                                            <!-- empty table -->
                                            <div @click="confirmAction('empty', t)" title=" Empty Table" class="flex h-7 w-7 items-center rounded-lg bg-yellow-600 text-black cursor-pointer">
                                                <div class="tag w-full h-full text-center font-medium text-white  flex flex-row justify-center items-center">
                                                    <i class="hgi hgi-stroke hgi-tornado-02"></i>
                                                </div>
                                            </div>

                                            <!-- export table -->

                                            <div @click="exportTable(t)" title="Export Table" class="flex h-7 w-7 items-center rounded-lg bg-blue-500 text-black cursor-pointer">
                                                <div class="tag w-full h-full text-center font-medium text-white  flex flex-row justify-center items-center">
                                                    <i class="hgi hgi-stroke hgi-file-download"></i>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="flex flex-col items-start justify-between font-light text-gray-600">
                                            <p class="text-[15px] font-bold" x-text="t"></p>
                                            <span class="text-xs font-light text-gray-400">just start writing with plain text</span>
                                        </div>
                                    </button>
                                </template>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- start status bar -->
                <div class="w-full h-20 bg-white absolute top-0 z-80 ">
                    <div class="flex flex-row gap-10 justify-center items-center h-full">

                        <!-- user -->
                        <div class="flex flex-col justify-center items-center h-full text-[#7a383f]">
                            <div class="text-3xl">
                                <i class="hgi hgi-stroke hgi-user-03"></i>
                            </div>
                            <div x-text="dbUser" class="text-md text-black text-sm text-semibold">

                            </div>
                        </div>

                        <!-- hostname -->
                        <div class="flex flex-col justify-center items-center h-full text-[#7a383f]">
                            <div class="text-3xl">
                                <i class="hgi hgi-stroke hgi-server-stack-02"></i>
                            </div>
                            <div x-text="dbHost" class="text-md text-black text-sm text-semibold">

                            </div>
                        </div>

                        <!-- database name -->
                        <div class="flex flex-col justify-center items-center h-full text-[#7a383f]">
                            <div class="text-3xl">
                                <i class="hgi hgi-stroke hgi-database"></i>
                            </div>
                            <div x-text="dbName" class="text-md text-black text-sm text-semibold">

                            </div>
                        </div>

                    </div>
                </div>
                <!-- end status bar -->

            </div>
            <!-- end dashboard screen -->
        </div>
    </template>


    <!-- main script -->
    <script>
        function oreoApp() {
            return {
                loggedIn: false,
                loading: true,
                dbName: '',
                dbHost: '',
                dbUser: '',
                tables: [],

                errorbar: {
                    open: false,
                    isError: true,
                    message: ''
                },
                modal: {
                    open: false,
                    action: '',
                    table: ''
                },
                loginForm: {
                    host: 'localhost',
                    db: '',
                    user: '',
                    pass: ''
                },

                // window statuses

                tablesWindow: false,
                importWindow: false,


                // handle import DB file selector
                openImportModal() {
                    this.sidebar = false
                    this.importWindow = true
                },

                async api(params = {}, formData = null, method = "POST") {
                    let url = "api.php";
                    if (method === "GET") {
                        url += "?" + new URLSearchParams(params);
                    }
                    const opts = {
                        method
                    };
                    if (formData) {
                        opts.body = formData;
                    } else if (method === "POST") {
                        opts.headers = {
                            "Content-Type": "application/x-www-form-urlencoded"
                        };
                        opts.body = new URLSearchParams(params);
                    }
                    const res = await fetch(url, opts);
                    if (res.headers.get("content-type")?.includes("application/json")) {
                        return await res.json();
                    } else {
                        return {
                            status: "error",
                            message: "Invalid response"
                        };
                    }
                },

                async checkSession() {
                    const res = await this.api({
                        action: "sessionCheck"
                    }, null, "GET");
                    if (res.status === "ok") {
                        this.loggedIn = true;
                        this.dbName = res.db;
                        this.dbHost = res.host;
                        this.dbUser = res.user;
                        this.loadTables();
                    } else {
                        this.loggedIn = false;
                    }
                    this.loading = false;
                },


                async login() {
                    const res = await this.api({
                        action: "login",
                        ...this.loginForm
                    });
                    if (res.status === "ok") {
                        this.loggedIn = true;
                        this.dbName = res.db;
                        this.dbHost = res.host;
                        this.dbUser = res.user;
                        this.loadTables();
                    } else {
                        alert(res.message);
                    }
                },

                async loadTables() {
                    const res = await this.api({
                        action: "list"
                    });
                    if (res.status === "ok") {
                        this.tables = res.tables;
                    } else {
                        alert(res.message);
                    }
                },

                async importSql() {
                    const file = this.$refs.sqlfile.files[0];
                    if (!file) return;
                    const formData = new FormData();
                    formData.append("sqlfile", file);
                    formData.append("action", "import");
                    const res = await this.api({}, formData, "POST");
                    alert(res.message);
                    if (res.status === "ok") this.loadTables();
                },

                exportDb() {
                    window.location = "api.php?action=exportDb";
                },

                exportTable(t) {
                    window.location = "api.php?action=exportTable&table=" + encodeURIComponent(t);
                },

                async emptyTable(t) {
                    const res = await this.api({
                        action: "empty",
                        table: t
                    });
                    alert(res.message);
                    if (res.status === "ok") this.loadTables();
                },

                async dropTable(t) {
                    if (!confirm("Drop table " + t + " ;")) return;
                    const res = await this.api({
                        action: "drop",
                        table: t
                    });
                    alert(res.message);
                    if (res.status === "ok") this.loadTables();
                },

                async logout() {
                    await this.api({
                        action: "logout"
                    });
                    this.loggedIn = false;
                    this.dbName = '';
                    this.dbHost = '';
                    this.dbUser = '';
                    this.tables = [];
                },



                confirmAction(action, table) {
                    this.modal.action = action;
                    this.modal.table = table;
                    this.modal.open = true;
                },


                async doAction() {
                    if (this.modal.action === 'drop') {
                        const res = await this.api({
                            action: "drop",
                            table: this.modal.table
                        });
                        alert(res.message);
                        if (res.status === "ok") this.loadTables();
                    } else if (this.modal.action === 'empty') {
                        const res = await this.api({
                            action: "empty",
                            table: this.modal.table
                        });
                        alert(res.message);
                        if (res.status === "ok") this.loadTables();
                    }
                    this.modal.open = false;
                }
            }
        }
    </script>





</body>

</html>