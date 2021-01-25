import React from "react";

export default function HiUser({ name, status }) {
  console.log(status);
  return (
    <div className="login-hiuser">
      <h2>Cześć {name},</h2>
      <button
        className="button primary"
        onClick={() => (window.location = `/${status}`)}
      >
        Przejdź do panelu
      </button>
    </div>
  );
}
