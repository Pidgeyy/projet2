// Simple front-end fetches for campus-helpdesk

async function getProfile() {
    const res = await fetch('/api/me');
    if (res.ok) {
        const data = await res.json();
        console.log(data);
    }
}

async function getTickets() {
    const res = await fetch('/api/tickets');
    if (res.ok) {
        const data = await res.json();
        console.log(data);
    }
}

// initialize
getProfile();
getTickets();
