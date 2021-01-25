import React from "react";

export default function Hello({user}) {
    const date = new Date().toLocaleDateString("pl-PL");
    return (
        <div className="teacherhome__hello">
            <h2>Witaj {user.first_name},</h2>
            <p>Dzisiaj jest {date}</p>
        </div>
    );
}
