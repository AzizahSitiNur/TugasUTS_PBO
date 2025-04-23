document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/calendar/events',  // Pastikan ini sesuai dengan route yang mengirimkan event
        eventClick: function(info) {
            // Menampilkan popup saat event diklik
            const eventDetails = `
                <strong>Ruangan:</strong> ${info.event.extendedProps.room_name}<br>
                <strong>Tujuan:</strong> ${info.event.extendedProps.description}<br>
                <strong>Waktu:</strong> ${info.event.start.toLocaleString()} - ${info.event.end.toLocaleString()}
            `;
            alert(eventDetails); // Menampilkan informasi event
        },
        
        dateClick: function(info) {
            const selectedDate = info.dateStr;
            console.log('Selected Date:', selectedDate); // Debug log
        
            const eventsOnDate = calendar.getEvents().filter(event => {
                return event.start.toISOString().split('T')[0] === selectedDate;
            });
        
            if (eventsOnDate.length > 0) {
                let eventDetails = '<ul>';
                eventsOnDate.forEach(event => {
                    eventDetails += `
                        <li>
                            <strong>Ruangan:</strong> ${event.extendedProps.room_name}<br>
                            <strong>Tujuan:</strong> ${event.extendedProps.description}<br>
                            <strong>Waktu:</strong> ${event.start.toLocaleString()} - ${event.end.toLocaleString()}
                        </li>
                    `;
                });
                eventDetails += '</ul>';
                alert(`Peminjaman pada tanggal ${selectedDate}:<br>${eventDetails}`);
            } else {
                alert('Tidak ada peminjaman pada tanggal ini.');
            }
        }        
    });

    calendar.render();
});
