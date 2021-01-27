import React from "react";
import "./dpage.scss";


function DPage() {

    return (
        <div className="dpage">
            <h1>Dyplomanci</h1>
            <div className="dpage">
                    <h3>Aktualnie brak dyplomantów</h3>
            </div>
        </div>
    );
}

export default function index(props) {
    return <DPage {...props} />;
}
