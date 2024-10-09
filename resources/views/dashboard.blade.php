<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div style="margin-bottom: 21px;padding:0px;margin-left: 414px;">
                        <div
                            style="
                        height: 200px;
                        width: 300px;
                    ">
                            <a class="btn btn-default btn-sm create-new"
                                style="margin-left: 20px; background-color:#00A896;color:white; font-size: 30px;"
                                title=" Create New Trainee" href="{{ URL::to('/pds') }}"> <i
                                    class="fa fa-plus create-new"></i></i>Personal Data
                                Sheet</a>
                            <h6 style="
                        margin-left: 108px;
                    ">click here
                                </h1>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
