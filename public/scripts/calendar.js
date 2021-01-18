const date = new Date()

const renderCalendar = () => {

    const monthDays = document.querySelector(".days");

    const lastDayOfMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

    const lastDayOfPrevMonth = new Date(date.getFullYear(), date.getMonth(), 0).getDate();

    let firstDayOfMonthIndex = new Date(date.getFullYear(), date.getMonth(), 1).getDay() - 1;
    if (firstDayOfMonthIndex < 0) {
        firstDayOfMonthIndex += 7;
    }

    let lastDayOfMonthIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay() - 1;
    if (lastDayOfMonthIndex < 0) {
        lastDayOfMonthIndex += 7;
    }

    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    document.querySelector('.header h1').innerHTML = months[date.getMonth()];
    document.querySelector('.header p').innerHTML = `${date.getFullYear()}`;

    let days = "";

    for (let i = firstDayOfMonthIndex; i > 0; i--) {
        days += `<div class="prev-month">${lastDayOfPrevMonth - i + 1}</div>`;
    }

    for (let i = 1; i <= lastDayOfMonth; i++) {
        if (i === new Date().getDate() && date.getMonth() === new Date().getMonth() && date.getFullYear() === new Date().getFullYear()) {
            days += `<div class="today">${i}</div>`;
        } else {
            days += `<div>${i}</div>`;
        }
    }

    for (let i = 1; i <= 7 - lastDayOfMonthIndex - 1; i++) {
        days += `<div class="next-month">${i}</div>`;
    }

    monthDays.innerHTML = days;
}

const showPrev = () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
}

const showNext = () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
}

renderCalendar();
