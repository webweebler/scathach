# Venues Page Field Mapping

This document explains how the fields you enter in WordPress admin map to the Venues page display.

## Show Admin Fields → Venues Page Display

### Featured Show (First/Upcoming Show)

| WordPress Field | Displays As | Example |
|----------------|-------------|---------|
| **Post Title** | Not displayed (internal reference only) | "Celtic Crown March" |
| **Featured Image** | Large image on left side | Upload via "Set featured image" |
| **Date** | Top of featured show content | "March 15, 2026" |
| **Venue Name** | Large heading below date | "The Celtic Crown Theatre" |
| **Location/City** | Below venue name in italics | "Dublin, Ireland" |
| **Show Description** | Paragraph text below location | "Join us for an unforgettable evening..." |
| **Doors Time** | In details line | "Doors: 7:00 PM" |
| **Show Time** | In details line | "Show: 8:00 PM" |
| **Ticket Price Range** | In details line | "€35-€65" |
| **Ticket Purchase Link** | "GET TICKETS" button | Links to external ticket site |

### Sidebar Shows (All Other Shows)

| WordPress Field | Displays As | Example |
|----------------|-------------|---------|
| **Date** | Month/Day box on left | "MAR 22" |
| **Venue Name** | Bold heading | "The Mystic Hall" |
| **Location/City** | Below venue name | "Cork, Ireland" |
| **Ticket Purchase Link** | "Get Tickets" link | Links to external ticket site |

## Important Notes

1. **Show Order**: Shows are sorted by the **Date** field (not by when you created them in WordPress)
   - First show = Featured show (large display)
   - All other shows = Sidebar shows

2. **Date Format**: Enter dates as readable text
   - Examples: "March 15, 2026", "Mar 22, 2026", "01 Feb 2026"
   - The sidebar will auto-parse month/day for display

3. **Featured Image**: Only used for the featured show (first upcoming show)

4. **Post Title**: This is for your reference in WordPress admin only - not displayed on frontend

## Quick Checklist for Adding a Show

- [ ] Title (internal reference)
- [ ] Date (determines sort order)
- [ ] Venue Name
- [ ] Location/City
- [ ] Description (for featured show only)
- [ ] Doors Time
- [ ] Show Time
- [ ] Ticket Price Range
- [ ] Ticket Purchase Link
- [ ] Featured Image (for featured show)
