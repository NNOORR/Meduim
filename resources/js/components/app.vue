<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
            <div class="container">
                <router-link class="navbar-brand" to="/">Articles</router-link>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                </div>

            </div>
        </nav>

        <router-view />
    </div>
</template>