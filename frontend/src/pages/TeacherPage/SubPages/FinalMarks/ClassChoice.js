import React, {useState} from 'react';
import "./finalMarks.scss";
import SelectedTable from "./SelectedTable";
import {useSelector} from "react-redux";

const ClassChoice = () => {
    const data = useSelector((state) => state.marks.finalGrades) || [];
    const [selectedOption, choicedSelectedOption] = useState(0);

    const studentsGroups = [...data].map((item, i) => {
        return (
            <option key={item.id_subject} value={item.id_subject}>
                {item.name} {"----"} {item.form}
            </option>
        )
    })

    const handleChange = (e) => {
        choicedSelectedOption(e.target.value)
    }
    return (
        <>
            <div className="classChoice">
                <form>
                    <select value={selectedOption} onChange={handleChange}>
                        <option value={0}>WYBIERZ GRUPĘ</option>
                        {studentsGroups}
                    </select>
                </form>
            </div>
            <div className="classTable">
                <SelectedTable selected={selectedOption}/>
            </div>
        </>
    );
};

export default ClassChoice;
