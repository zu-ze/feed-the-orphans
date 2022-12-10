import React, { memo } from 'react';
import {View, Text, FlatList, useWindowDimensions, TouchableOpacity } from 'react-native';
import { styles } from '../core/Theme';

const ContactTab = ({title, contacts}) => {
    const contentWidth = useWindowDimensions().width;

    const ListItem = ({item}) => {

      return (
        <TouchableOpacity style={styles.ListItem} >
            <View style={styles.ListItemView}>
                <Text style={styles.ListItemViewText, {fontSize: 18}}>{item.number}</Text>
                <Text style={[styles.ListItemViewText, {fontSize: 12}]}>{item.name}</Text>
            </View>
        </TouchableOpacity>
      );
    }

    return (
          <View
            style={
              [
                styles.container, 
                {
                  flexDirection: "column", 
                  justifyContent: "flex-start", 
                  borderRadius: 5, 
                  marginTop: 10,
                  backgroundColor: "#4b88a2", 
                  width: "98%" 
                }
              ]
            }
          >
            {/* ######################## */}
            <View  
              style={
                { 
                  backgroundColor: "white", 
                  position: "absolute",
                  top: 0,
                  zIndex: 2,
                  padding: 10, 
                  width: '90%', 
                  borderRadius: 5 
                }
              }
            >
              <Text style={{fontSize: 18}} >{title}</Text>
            </View>
            {/* ######################## */}

            {/* ######################## */}
            <View style={{ marginTop: 10, paddingVertical: 40, width: '90%', height: "100%"}} >
                <FlatList 
                  data={contacts}
                  renderItem={ ({item}) => <ListItem item={item} /> } 
                />
            </View>
            {/* ######################## */}
          </View>
    )
}

export default memo(ContactTab);