// Get current date
const now = new Date();

// Set up calendar
const calendar = {
  month: now.getMonth(),
  year: now.getFullYear(),
  days: [],
  generateHTML: function() {
    // First day of the month
    const firstDayOfMonth = new Date(this.year, this.month, 1);
    // Last day of the month
    const lastDayOfMonth = new Date(this.year, this.month + 1, 0);
    // First day of the week (Sunday)
    const firstDayOfWeek = 0;
    // Last day of the week (Saturday)
    const lastDayOfWeek = 6;

    // Clear previous days
    this.days = [];

    // Add previous month days
    for (let i = firstDayOfMonth.getDay(); i > firstDayOfWeek; i--) {
      const date = new Date(this.year, this.month, 0 - i + 1);
      this.days.push({ date: date, disabled: true });
    }

// Add current month days
for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
    const date = new Date(year, month, i);
    const dayOfWeek = date.getDay();
    const dayOfMonth = date.getDate();
    
    // Create a cell for each day of the month
    const cell = document.createElement('div');
    cell.classList.add('calendar-cell', 'calendar-day');
    cell.dataset.date = date.toISOString();
  
    // Add day of the month as text
    const text = document.createTextNode(dayOfMonth);
    cell.appendChild(text);
  
    // Add CSS class for weekend days
    if (dayOfWeek === 0 || dayOfWeek === 6) {
      cell.classList.add('calendar-weekend');
    }
  
    // Add CSS class for today's date
    if (date.toDateString() === today.toDateString()) {
      cell.classList.add('calendar-today');
    }
  
    // Add click event listener to select date
    cell.addEventListener('click', () => {
      const selectedDate = new Date(cell.dataset.date);
      selectDate(selectedDate);
    });
  
    // Append cell to row
    row.appendChild(cell);
  
    // If last day of week, start new row
    if (dayOfWeek === lastDayOfWeek) {
      calendar.appendChild(row);
      row = document.createElement('div');
      row.classList.add('calendar-row');
      lastDayOfWeek = getNextDayOfWeek(dayOfWeek);
    }
  }
  
  // Append last row to calendar
  if (row.children.length > 0) {
    calendar.appendChild(row);
  }
  }
}