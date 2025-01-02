<style>
    @keyframes slide-up {
        0% {
            transform: translateY(100%); /* Startar från botten (utanför skärmen) */
        }
        100% {
            transform: translateY(0); /* Slutar på sin normala plats */
        }
    }

    .animate-slide-up {
        animation: slide-up 0.5s ease-out forwards; /* Tillämpa animationen på bannern */
    }
</style>
