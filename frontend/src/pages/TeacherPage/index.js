import React, {Suspense, useState, lazy} from "react";
import "./teacherpage.scss";
import LeftMenu from "./LeftMenu";

import TeacherMenu from './TeacherMenu';
import {useDispatch} from "react-redux";
import {login} from "../../actions/auth";
import {Route, Switch} from "react-router-dom";


const HomePage = lazy(() => import("./SubPages/HomePage"));
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));

const LoggedUser = {
    firstname: "Grażyna",
    lastname: "Żarko",
    index: "gż3322",
    avatar:
        "https://tmtown.s3.amazonaws.com/uploads/user/image/328772/super_large_hochnadel_avatar.jpg",
};

function App() {
    const dispatch = useDispatch();
    dispatch(login(LoggedUser));
    const [isMenuOpen, setIsMenuOpen] = useState(false);

    return (
        <div className="user-page">
            <LeftMenu open={isMenuOpen} setopen={setIsMenuOpen}/>
            <div className="content">
                <Suspense fallback={<div className="loading"></div>}>
                    <Switch>
                        <Route path="/teacher" component={HomePage} exact/>
                        <Route path="/teacher/plan-zajec/" component={TimeTablePage}/>
                    </Switch>
                </Suspense>
            </div>
            <TeacherMenu open={isMenuOpen} setopen={setIsMenuOpen}/>

        </div>
    );
}

export default function index() {
    return <App/>;
}
