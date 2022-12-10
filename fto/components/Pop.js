import React, {useState, memo} from "react";
import { Snackbar} from "react-native-paper"

const Pop = ({show, type, message}) => {
    const [visible, setVisible] = React.useState(show);
    const onToggleSnackBar = () => setVisible(!visible);
    const onDismissSnackBar = () => setVisible(false);

    return (
            <Snackbar
                visible={visible}
                onDismiss={onDismissSnackBar}
                style={{
                    backgroundColor: "#4b88a2"
                }}
                action={{
                }}
            >
                {message}
            </Snackbar>
    )
}

export default memo(Pop); 