import React from "react";

export default function Hello({teachername}) {
    const date = new Date().toLocaleDateString("pl-PL");
    return (
        <div className="teacherhome__hello">
            <h2>Witaj {teachername},</h2>
            <p>Dzisiaj jest {date}</p>
        </div>
    );
}
