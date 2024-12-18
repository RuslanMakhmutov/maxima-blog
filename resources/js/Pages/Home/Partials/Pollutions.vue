<script setup>
defineProps({
    air: {
        type: Object,
    }
});

const aqi = {
    1: {title: 'Хороший', class: 'text-green-400'},
    2: {title: 'Нормальный', class: 'text-lime-500'},
    3: {title: 'Удовлетворительный', class: 'text-amber-400'},
    4: {title: 'Плохой', class: 'text-orange-500'},
    5: {title: 'Очень плохой!', class: 'text-red-600'},
}
</script>

<template>
    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-6">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 mb-2">
                    Информация о качестве воздуха в Вашем городе на {{ new Date(air.dt * 1000).toLocaleString() }}<br>
                </h2>
            </header>
            <p>Индекс качества воздуха: <span :class="aqi[air.main.aqi].class">{{ aqi[air.main.aqi].title }}</span></p>
            <p>Окись азота: <span>{{ air.components.no2 }}</span></p>
            <p>Озон: <span>{{ air.components.o3 }}</span></p>
            <p>Диоксид серы: <span>{{ air.components.so2 }}</span></p>
            <p>PM2.5: <span>{{ air.components.pm2_5 }}</span></p>
            <p>PM10: <span>{{ air.components.pm10 }}</span></p>
        </section>
    </div>
</template>
